<?php

namespace App\Http\Controllers;

use App\Exports\UsersCreateExport;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Imports\UsersImport;
use App\MasterFile;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Validators\Failure;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:users.create')->only(['store','create']);
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.edit')->only(['update','edit']);
        $this->middleware('can:users.show')->only('show');
        $this->middleware('can:users.destroy')->only('destroy');
        $this->middleware('can:users.upload')->only(['upload','uploadStore','downloadUsersCreated']);
    }

    public function upload(Request $request){
               
        try {
            $import = new UsersImport();
            $temp = Excel::import($import,request()->file('uploadUsers'));            
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        
        $users = $import->array;

        $rules = [
            'national_id' => ['required','unique:users','exists:master_files,national_id'],
            'email' => ['required', 'string', 'email', 'max:255','regex:/(\W|^)[\w.\-]{2,25}@(ncri|contactpoint360|cp-360)\.com(\W|$)/' , 'unique:users'],
            'username' => ['required', 'string', 'max:50','regex:/^[a-z ñ]{2,20}\.[a-zñ0-9\-]{2,20}$/i','unique:users'],
        ];

        $customMessages=[
            'email.unique'=>'The email ":input" has already been taken.',
            'email.regex'=>'The email ":input" format is invalid.',
            'email.email'=>'The email ":input" must be a valid email address.',
            'username.unique'=>'The username ":input" has already been taken.',
            'username.regex'=>'The username ":input" format is invalid.',
        ];

        $data = [];
        $validations = [];
        foreach($users as $user){
            $user['national_id'] = strval($user['national_id']);
            $user['email'] = strtolower($user['email']);
            $user['username'] = (isset($user['username']) && $user['username'] != null ? $user['username'] : substr($user['email'],0,strpos($user['email'],"@")));
            $user['role'] = (isset($user['role']) && $user['role'] != null ? intval($user['role']) : null);
            $validation = Validator::make($user,$rules,$customMessages)->errors()->all();


            $masterfile = MasterFile::where('national_id',$user['national_id'])
            ->select('full_name','campaign','position','status')
            ->orderBy('joining_date','DESC')
            ->get();

            $masterfile = ($masterfile->isEmpty() ? null : $masterfile->first());

            $user['masterfile'] = $masterfile;
            if($masterfile && $masterfile->status == 'Inactive'){
                array_push($validation,'Employee is not active.');
            }
            if(count($validation)>0){
                $validations[] = [
                    'national_id'=>$user['national_id'],
                    'validation'=>$validation
                ];
            }
            $data[]=$user;
        }

        if($validations){return back()->with('validation', $validations);}

        $roles = Role::where('slug','!=','admin')->select('id','name')->get();

        return view('users.update',compact('data','roles'));
    }

    public function uploadStore(Request $request){
        $usersExport = [];
        foreach($request->all() as $user){
            $user = new Request($user);
            $user->merge([
                'name' => $user->fullname,
                'password' => Hash::make($user->username.'**'),
                ]);
            $usersExport[] = [
                'national_id'=>$user->national_id,
                'name'=>$user->name,
                'email'=>$user->email,
                'username'=>$user->username,
                'password'=>$user->username.'**',
            ];
                
            $userCreate = User::create($user->only(['username','name','national_id','email','password']));
            $userCreate->roles()->sync([$user->role]);
        }

        Excel::store(new UsersCreateExport($usersExport), 'storage/users/userscreated.xlsx');

        return 'OK';
    }

    public function downloadUsersCreated(){
        return Storage::download('/storage/users/userscreated.xlsx');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            // Get last ids from master_files
            $latestIdMasterFile = MasterFile::groupBy('national_id')->select('national_id',DB::raw('MAX(id) AS id'));
            $masterfile = Masterfile::joinSub($latestIdMasterFile,'latest_id_master_file','master_files.id','latest_id_master_file.id')
            ->select('master_files.national_id as nid',
            'master_files.full_name',
            'master_files.position',
            'master_files.campaign',
            'master_files.supervisor',
            'master_files.status');
            $arr = [];
            $arr["data"] = User::with('roles')->leftJoinSub($masterfile,'masterfile','users.national_id','masterfile.nid')->get();
            return $arr;
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $users = User::whereDoesntHave('roles', function($query){
            $query->where('roles.name','Agent');
        })->pluck('name','id')->toArray();

        return view('users.create', compact('roles','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->merge([
            'username' => Str::lower($request->username),
            'password' => Hash::make($request->password)
        ])->all());

        //update Roles
        $user->roles()->sync($request->get('roles'));

        return redirect('users')->with('info', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        $users = User::pluck('name','id')->toArray() ;
        return view('users.edit', compact('user', 'roles','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        //update User
        $hasPassword = $request->password;

        $user->update(
            $request->merge(['password' => Hash::make($request->password)])
                ->except([$hasPassword ? '' : 'password'])
        );

        //update Roles
        $user->roles()->sync($request->get('roles'));



        return redirect()->route('users.edit', $user->id)
            ->with('info', 'User saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('info', 'Successfully removed');
    }
}
