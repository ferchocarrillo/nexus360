<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UsersLogout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:logout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        // Get date and time from 10 hours ago
        $dateTime = \Carbon\Carbon::now()->subHours(10)->toDateTimeString();

        // Get all activitys that are older than 10 hours
        $activityUser = DB::table('activity_user')
        ->where('updated_at','<=',$dateTime)
        ->where('activity_id','<>', 2)
        ;

        // Get all users who logged in before 10 hours ago
        $users = User::joinSub($activityUser, 'activity_user', function ($join) {
            $join->on('users.id', '=', 'activity_user.user_id');
        })->select('users.*')->get();

        // Logout all users who logged in before 10 hours ago
        foreach ($users as $user) {
            $user->logout();
        }

        \Log::info('UsersLogout:: ' . count($users).' users logged out');

        $this->info('UsersLogout:: ' . count($users).' users logged out');
    }
}
