<?php

use App\PayrollAdmin;
use Illuminate\Database\Seeder;

class PayrollAdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PayrollAdmin::truncate();
        PayrollAdmin::create([
            'name' => 'positions',
            'value' => [
                'Agent',
                'Agent Booking Specialist',
                'SFL Customer Support Specialist',
                'SFL Failed Payments',
                'Support Facilitator',
                'Onboarding specialist',
            ]
        ]);
        PayrollAdmin::create([
            'name' => 'days_before',
            'value' => 3
        ]);
    }
}
