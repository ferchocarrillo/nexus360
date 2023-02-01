<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PayrollReportMail extends Mailable
{
    use Queueable, SerializesModels;

    private $mail;
    private $manager;
    private $filepath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($manager, $mail, $filepath)
    {

        $this->mail = $mail;
        $this->manager = $manager;
        $this->filepath = $filepath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('prenomina.mail.prenominareport')
        ->subject('Prenomina Report - '.$this->manager)
        ->to($this->mail)
        ->cc(['diego.pinzon@contactpoint360.com','luisa.becerra@contactpoint360.com','juand.cuellar@contactpoint360.com'])
        // ->attach(\Swift_Attachment::fromPath($filepath));
        ->attach($this->filepath);

    }
}




