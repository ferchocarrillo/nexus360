<?php

namespace App\Jobs;

use App\Kaizen;
use App\KaizenComment;
use App\Mail\KaizenMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class KaizenSendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $kaizen;
    public $comment;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Kaizen $kaizen,KaizenComment $comment = null)
    {
        $this->kaizen = $kaizen;
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new KaizenMail($this->kaizen,$this->comment);
        Mail::to('reporting.bogota@cp-360.com')->send($email);
    }
}
