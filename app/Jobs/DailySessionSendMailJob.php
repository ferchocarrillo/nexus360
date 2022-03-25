<?php

namespace App\Jobs;

use App\DailySession;
use App\Mail\DailySessionMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DailySessionSendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $dailySession;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DailySession $dailySession)
    {
        $this->dailySession = $dailySession;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new DailySessionMail($this->dailySession);
        Mail::send($email);
    }
}
