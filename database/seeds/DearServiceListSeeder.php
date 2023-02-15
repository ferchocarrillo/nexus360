<?php

use App\DearServiceList;

use Illuminate\Database\Seeder;

class DearServiceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DearServiceList::truncate();
        DearServiceList::create([
            'name' => 'disposition',
            'list' => [
                'Abandoned Call',
                'Booked',
                'Customer Will Call Back ',
                'Deceased ',
                'Do Not Call List (Dnc)',
                'Hung Up After Greeting',
                'Hung Up Mid-Call',
                'Language Barrier',
                'Moving',
                'Not Insterested - Different Service Provider',
                'Not Interested - Decline Prices',
                'Not Interested - Information Shared',
                'Not Interested - Not Sattisfied With Previous Service',
                'Not Living In Washington',
                'Voicemail',
                'Wrong Number',
            ]
        ]);
    }
}
