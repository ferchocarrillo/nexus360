<?php

use App\EnercareCalltrackerReasonsNotPitchAndSales;
use Illuminate\Database\Seeder;

class EnercareCallTrackerNotPitchAndSalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Repeat caller, meaning the customer called within the last 30 days for the same reason','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Customer is upset','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Not Decision Maker (e.g. tenant, service contact, son, daughter, etc)','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Customer already has all plans possible with Enercare','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Commercial customers','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Unresolved escalations','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Media, legal threat','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Emergency Calls types','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Loyalty customer (wants to cancel)','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Call not completed','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Unsure how to make pitch cannot relate original call to a sales pitch','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Customer does not have time and ends call before agent makes pitch','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Poor experience with Enercare - field complaint','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Poor experience with Enercare - escalation/process complaint','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Not eligible for coverage (ex moving to condo, retierment home, out of country, ect)','type'=>'NotPitch','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Collections charges','type'=>'NotSaleBilling','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Cannot move the plans','type'=>'NotSaleBilling','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Tenant calling','type'=>'NotSaleBilling','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Repeat escalation','type'=>'NotSaleBilling','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Supervisor immediately','type'=>'NotSaleBilling','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Have every single plan the can be offered','type'=>'NotSaleBilling','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Have all the coverage','type'=>'NotSaleService','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Buyout','type'=>'NotSaleService','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Repeat calls highly escalated','type'=>'NotSaleService','active'=> 1]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(['name'=> 'Emergency calls','type'=>'NotSaleService','active'=> 1]);
    }
}
