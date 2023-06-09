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
                'Agent Outbound Sale',
            ]
        ]);
        PayrollAdmin::create([
            'name' => 'days_before',
            'value' => 3
        ]);

        PayrollAdmin::create([
            'name' => 'emails_reportadjustmentspending',
            'value' => [
                'juand.cuellar@contactpoint360.com',
                'diego.pinzon@contactpoint360.com',  
                'jose.paez@contactpoint360.com',
                'alex.gallo@contactpoint360.com',
                'luisa.becerra@contactpoint360.com',
            ]
        ]);
    }
}
