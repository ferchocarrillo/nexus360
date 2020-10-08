<?php

use App\Activity;
use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::firstOrCreate(['name' => 'Login','isActive' => 1,'icon' => 'fas fa-sign-in-alt','color' => '#38c172 !important']);
        Activity::firstOrCreate(['name' => 'Logout','isActive' => 1,'icon' => 'fas fa-sign-out-alt','color' => '#343a40 !important']);
        Activity::firstOrCreate(['name' => 'Ready','isActive' => 1,'icon' => 'fas fa-play','color' => '#28a745 !important']);
        Activity::firstOrCreate(['name' => 'Training','isActive' => 1,'icon' => 'fas fa-chalkboard-teacher','color' => '#17a2b8 !important']);
        Activity::firstOrCreate(['name' => 'Coaching','isActive' => 1,'icon' => 'fas fa-users','color' => '#1a535c !important']);
        Activity::firstOrCreate(['name' => 'Break','isActive' => 1,'icon' => 'fas fa-coffee','color' => '#f6993f !important']);
        Activity::firstOrCreate(['name' => 'Lunch','isActive' => 1,'icon' => 'fas fa-drumstick-bite','color' => '#ff4438 !important']);
        Activity::firstOrCreate(['name' => 'Support','isActive' => 1,'icon' => 'fas fa-hand-rock','color' => '#231161 !important']);
        Activity::firstOrCreate(['name' => 'Issues','isActive' => 1,'icon' => 'fas fa-exclamation-triangle','color' => '#6c757d !important']);
        Activity::firstOrCreate(['name' => 'Supervisor Call','isActive' => 1,'icon' => 'fas fa-headset','color' => '#138D75 !important']);
    }
}
