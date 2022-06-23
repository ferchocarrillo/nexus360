<?php

namespace App\Mail;

use App\PandorasBox;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PandorasBoxMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $pandora;

    public function __construct(PandorasBox $pandora)
    {
        $this->pandora = $pandora;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pandorasbox.mail.notification')->with(['message'=>$this])
        ->subject('Pandoras Box Notification')
        ->to([
            'brigitte.pardo@contactpoint360.com',
            'heidy.morales@contactpoint360.com',
            'juand.cuellar@contactpoint360.com',
        ]);
    }
}
