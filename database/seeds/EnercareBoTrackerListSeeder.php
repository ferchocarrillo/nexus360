<?php

use App\EnercareBoTrackerList;
use Illuminate\Database\Seeder;

class EnercareBoTrackerListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EnercareBoTrackerList::truncate();
        EnercareBoTrackerList::create([
            'name' => 'lob',
            'list' => [
                'OBA',
                'OFFLINE',
            ]
        ]);
        EnercareBoTrackerList::create([
            'name' => 'OBA',
            'list' => [
                'OBA Case',
                'OBA Audit Billing Adjustment',
            ]
        ]);
        EnercareBoTrackerList::create([
            'name' => 'OFFLINE',
            'list' => [
                'Back-Billing',
                'Back-BillingBack-Billing',
                'Billing Adjustment',
                'Billing Offline Emails',
                'Callbacks',
                'Contact Us Promo',
                'HVAC (Downgrade)',
                'HVAC (Rental)',
                'HVAC Inbox',
                'Misrepresentations',
                'Moves',
                'Request Inquiry',
                'SME Case',
                'TGS (Report)'
            ]
        ]);


    }
}
