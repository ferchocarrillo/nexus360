<?php

use App\KaizenList;
use Illuminate\Database\Seeder;

class KaizenListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KaizenList::truncate();
        KaizenList::create([
            'name' => 'groups',
            'list' => [
                'Reporting',
                'Workforce',
                'Schedules',
                'Development',
            ]
        ]);

        KaizenList::create([
            'name' => 'types',
            'list' => [
                'Create',
                'Modify',
                'Check',
                'Remove',
            ]
        ]);

        KaizenList::create([
            'name' => 'schedules_types',
            'list' => [
                'Schedule change',
                'Paid License',
                'Unpaid Leave',
                'Holidays',
            ]
        ]);

        KaizenList::create([
            'name' => 'statuses',
            'list' => [
                'Pending',
                'In Progress',
                'Pending Review',
                'On Hold',
                'Closed',
            ]
        ]);

        KaizenList::create([
            'name' => 'approved',
            'list' => [
                'Approved',
                'Not Approved',
                'Approved by Ops',
            ]
        ]);

        KaizenList::create([
            'name' => 'positions',
            'list' => [
                'Agent',
                'Agent Booking Specialist',
                'SFL Customer Support Specialist',
                'SFL Failed Payments',
                'Support Facilitator',
                'Onboarding specialist',
            ]
        ]);
    }
}
