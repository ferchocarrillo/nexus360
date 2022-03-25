<?php

namespace App\Mail;

use App\DailySession;
use App\User;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailySessionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dailySession;
    // private $bcc;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DailySession $dailySession)
    {
        $this->dailySession =  $dailySession;
    }

    /**
     * @return []
     */

    private function getBCC(){
        $emails = [];
        $permission = Permission::where('slug','dailysessions.email')->first();
        if(!$permission)return $emails;
        $roles= $permission->roles;
        foreach ($roles as $rol) {
            foreach ($rol->users as $user) {
                $emails[] = $user->email;
            }   
        }
        return $emails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('DailySession.mails.create_notification')->with(['message'=>$this])
        ->to($this->dailySession->corporate_email)
        ->cc($this->dailySession->creator->email)
        ->bcc($this->getBCC())
        ->subject(!$this->dailySession->acknowledge ? 'New Daily Session Created' : "Daily Session Acknowledged!");
    }
}
