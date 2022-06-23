<?php

namespace App\Jobs;

use App\Mail\PandorasBoxMail;
use App\PandorasBox;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PandorasBoxMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $pandora;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(PandorasBox $pandora)
    {
        $this->pandora = $pandora;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new PandorasBoxMail($this->pandora);
        Mail::send($email);
    }
}
