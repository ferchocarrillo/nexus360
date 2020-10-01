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
        Activity::create([
            'name' => 'Login',
            'isActive' => 1
        ]);
        Activity::create([
            'name' => 'Logout',
            'isActive' => 1
        ]);
        Activity::create([
            'name' => 'Ready',
            'isActive' => 1
        ]);
        Activity::create([
            'name' => 'Training',
            'isActive' => 1
        ]);
        Activity::create([
            'name' => 'Coaching',
            'isActive' => 1
        ]);
        Activity::create([
            'name' => 'Break',
            'isActive' => 1
        ]);
        Activity::create([
            'name' => 'Lunch',
            'isActive' => 1
        ]);
        Activity::create([
            'name' => 'Support',
            'isActive' => 1
        ]);
        Activity::create([
            'name' => 'Issues',
            'isActive' => 1
        ]);
    }
}
