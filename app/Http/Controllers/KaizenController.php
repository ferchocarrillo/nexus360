<?php

namespace App\Http\Controllers;

use App\Kaizen;
use App\MasterFile;
use App\User;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use stdClass;

class KaizenController extends Controller
{

    public $groups;
    public $campaigns;
    public $types;
    public $schedules;
    public $status;
    public $agents;

    public function __construct()
    {
        $this->middleware('can:kaizen')->only(['create','store']);
        $this->middleware('can:kaizen')->only('index');
        $this->middleware('can:kaizen.admin')->only(['edit','update','assign']);
        $this->middleware('can:kaizen')->only('show','comment','downloadfile');
        $this->middleware('can:kaizen.admin')->only('destroy');

        // dd( $this->getKaizenBCC());
    }

    private function defineVars(){
        $this->groups=['Reporting','Workforce','Schedules','Development'];
        $this->campaigns= MasterFile::whereNull('termination_date')->select('campaign')->groupBy('campaign')->pluck('campaign');
        $this->types=['Create','Modify','Check','Remove'];
        $this->schedules=['Schedule change','Paid License','Unpaid Leave','Holidays'];
        $this->status=['Pending','In Progress','Pending Review','On Hold','Closed'];
        $national_ids = MasterFile::whereNull('termination_date')->where('position','Agent')->select('national_id')->groupBy('national_id')->pluck('national_id');
        $this->agents =User::whereIn('national_id',$national_ids)->get();
    }

    private function sendMail($mail){
        $mail->bcc = $this->getKaizenBCC();
        Mail::raw(json_encode($mail),function($message) use($mail){
            $message->to("reporting.bogota@cp-360.com")
            ->subject("Kaizen Email");
        });
    }

    private function getKaizenBCC(){
        $members = DB::table('users')
        ->leftJoin('role_user','users.id','=','role_user.user_id')
        ->leftJoin('roles','role_user.role_id', '=', 'roles.id')
        ->leftJoin('permission_role','roles.id', '=', 'permission_role.role_id')
        ->leftJoin('permissions','permission_role.permission_id','=','permissions.id')
        ->where('permissions.slug','kaizen.email')
        ->select('users.email')
        ->groupBy('users.email')
        ->get()->pluck('email')->toArray();
        return join(';',$members);
    }

    private function permission(){
        if(Auth::user()->hasPermissionTo('kaizen.admin'))return 'kaizen.admin';
        if(Auth::user()->hasPermissionTo('kaizen.team'))return'kaizen.team';
        if(Auth::user()->hasPermissionTo('kaizen.operations'))return'kaizen.operations';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        

        if(Auth::user()->hasPermissionTo('kaizen.admin')){
            $kaizens = Kaizen::with('assigned','required')->get();
        }else{
            $kaizens = Kaizen::with('assigned','required')->where('assigned_to',Auth::user()->id)
            ->orWhere('required_by',Auth::user()->id)
            ->get();
        }

        return view('Kaizen.index',compact(['kaizens']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->defineVars();
        $groups= $this->groups;
        $campaigns= $this->campaigns;
        $types= $this->types;
        $schedules= $this->schedules;
        $employess = $this->agents;
        return view('Kaizen.create',compact(['groups','campaigns','types','schedules','employess']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrFile = null;
        if($request->file){
            $name_file = $request->file('file')->getClientOriginalName();
            $path_file = $request->file->store('storage/kaizen');
            $arrFile = [
                'name_file'=>$name_file,
                'path_file'=>$path_file
            ];
            $arrFile = json_encode($arrFile);
        }
        $kaizen = Kaizen::create(
            $request->merge([
                'required_by'=> Auth::user()->id,
                'file_path'=>$arrFile,
                'status'=>'Pending',
            ])->except(['_token','file'])
        );

        
        $kaizen->description = str_replace("\n","<br>",$kaizen->description);
        $mail= new stdClass;
        $mail->body = view('kaizen.mails.create',compact('kaizen'))->render();
        $mail->to=$kaizen->required->email;
        $mail->subject="Kaizen Received - [#".$kaizen->id."] ".$kaizen->title;
        $this->sendMail($mail);

        return ['result'=>'success'];
    }

    public function assign(Request $request){
        $kaizen = Kaizen::find($request->kaizen_id);

        if(Auth::user()->hasPermissionTo('kaizen.admin')){

            $msj= null;
            $assigned_to = $kaizen->assigned_to;
            $deadline = $kaizen->deadline;


            $kaizen->assigned_to = $request->assigned_to;
            $kaizen->deadline = $request->deadline;
            $kaizen->save();

            if($assigned_to != $request->assigned_to){
                $msj .= 'Kaizen assigned to '.$kaizen->assigned->name."\n";
            }
            if($deadline != '' && $deadline!=$request->deadline){
                $msj .= 'Deadline changed to '.$kaizen->deadline."\n";
            }

            if($msj != null){
                $comment = $kaizen->comments()->create([
                    'comment'=>$msj,
                    'status'=>$kaizen->status,
                    'created_by'=>Auth::user()->id,
                ]);


                $mail= new stdClass;
                $mail->body = view('kaizen.mails.comment',compact(['kaizen','comment']))->render();
                $mail->subject=($comment->status == 'Closed'?"Kaizen Resolved":"Kaizen New comment")." - [#".$kaizen->id."] ".$kaizen->title;        
                $mail->to=$kaizen->required->email;
                if($kaizen->assigned_to) $mail->cc = $kaizen->assigned->email;
                $this->sendMail($mail);
            }

            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kaizen  $kaizen
     * @return \Illuminate\Http\Response
     */
    public function show(Kaizen $kaizen)
    {
        $kaizen = $kaizen->with('required','assigned','comments.user')->find($kaizen->id);
        if(!Auth::user()->hasPermissionTo('kaizen.admin') 
            && $kaizen->assigned_to !=Auth::user()->id
            && $kaizen->required_by !=Auth::user()->id){
            abort(404);
        }        
        if($kaizen->schedules) $kaizen->schedules = json_decode($kaizen->schedules);
        if($kaizen->file_path) $kaizen->file_path = json_decode($kaizen->file_path);

        $members = DB::table('users')
        ->leftJoin('role_user','users.id','=','role_user.user_id')
        ->leftJoin('roles','role_user.role_id', '=', 'roles.id')
        ->leftJoin('permission_role','roles.id', '=', 'permission_role.role_id')
        ->leftJoin('permissions','permission_role.permission_id','=','permissions.id')
        ->where('permissions.slug','kaizen.team')
        ->select('users.id','users.name')
        ->groupBy('users.id','users.name')
        ->get();

        $this->defineVars();
        $groups= $this->groups;
        $campaigns= $this->campaigns;
        $types= $this->types;
        $schedules= $this->schedules;
        $employess = $this->agents;
        $status = $this->status;
        // $permission='kaizen.operations';
        $permission=$this->permission();
        return view('Kaizen.show',compact(['groups','campaigns','types','schedules','employess','status','permission','kaizen','members']));
    }

    public function comment(Request $request){

        $kaizen = Kaizen::findOrFail($request->kaizen_id);

        if(!Auth::user()->hasPermissionTo('kaizen.admin') 
            && $kaizen->assigned_to !=Auth::user()->id
            && $kaizen->required_by !=Auth::user()->id){
            abort(404);
        }

        $kaizen->status = $request->status;
        $kaizen->save();

        $comment = $kaizen->comments()->create([
            'comment'=>str_replace("\n","<br>",$request->comment),
            'status'=>$request->status,
            'created_by'=>Auth::user()->id,
        ]);

        $mail= new stdClass;
        $mail->body = view('kaizen.mails.comment',compact(['kaizen','comment']))->render();
        $mail->subject=($comment->status == 'Closed'?"Kaizen Resolved":"Kaizen New comment")." - [#".$kaizen->id."] ".$kaizen->title;        
        $mail->to=$kaizen->required->email;
        if($kaizen->assigned_to) $mail->cc = $kaizen->assigned->email;
        $this->sendMail($mail);
        
        return $comment;
    }

    public function downloadfile($id){
        $kaizen = Kaizen::findOrFail($id);
        if(!Auth::user()->hasPermissionTo('kaizen.admin') 
        && $kaizen->assigned_to !=Auth::user()->id
        && $kaizen->required_by !=Auth::user()->id){
        abort(404);
        }
        if(!$kaizen->file_path)abort(404);
        $file_path = json_decode($kaizen->file_path);
        return  Storage::download($file_path->path_file,$file_path->name_file);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kaizen  $kaizen
     * @return \Illuminate\Http\Response
     */
    public function edit(Kaizen $kaizen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kaizen  $kaizen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kaizen $kaizen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kaizen  $kaizen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kaizen $kaizen)
    {
        //
    }
}
