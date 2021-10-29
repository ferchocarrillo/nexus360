<?php

use App\AmericanWaterBoTrackerList;
use Illuminate\Database\Seeder;

class AmericanWaterBoTrackerListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AmericanWaterBoTrackerList::truncate();

        AmericanWaterBoTrackerList::create([
            'name' => 'queues',
            'list' => [
                "AWRL Current Credits"=>["endForm"=>0],
                "Problem Payment Issue"=>["endForm"=>1],
            ]
        ]);

        AmericanWaterBoTrackerList::create([
            'name' => 'statuses',
            'list' => [
                "Complete"=>["gotoENR"=>0],
                "Pending - AR Review"=>["gotoENR"=>0],
                "Pending - Personal"=>["gotoENR"=>0],
                "Pending - Claims"=>["gotoENR"=>0],
                "On Hold - ENR"=>["gotoENR"=>1],
                "On Hold - RM"=>["gotoENR"=>1],
            ]
        ]);

        AmericanWaterBoTrackerList::create([
            'name' => 'agreement_classifications',
            'list' => [
                'Re-Enrollment',
                'Renewal',
                'New'
            ]
        ]);
    }
}
