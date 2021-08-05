<?php

namespace App\Mail;

use App\Kaizen;
use App\KaizenComment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use stdClass;

class KaizenMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kaizen;
    public $comment;
    public $mail;

    public function __construct(Kaizen $kaizen,KaizenComment $comment = null)
    {
        $this->kaizen = $kaizen;
        $this->comment = $comment;
        $this->mail= new stdClass;
        if($comment){
            if($kaizen->status == 'Closed'){
                $this->mail->subject = "Kaizen Resolved";
            }else{
                $this->mail->subject = "Kaizen New Comment";
            }
        }else{
            $this->mail->subject = "Kaizen Received";
        }
        $this->mail->subject.= " - #".$kaizen->id." ".$kaizen->title;
        $this->mail->to=$kaizen->required->email;
        $this->mail->bcc = $this->getKaizenBCC();
        if($kaizen->assigned_to) $this->mail->cc = $kaizen->assigned->email;
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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Kaizen.mails.create')->with(['message'=>$this])->subject(json_encode($this->mail));
    }
}
