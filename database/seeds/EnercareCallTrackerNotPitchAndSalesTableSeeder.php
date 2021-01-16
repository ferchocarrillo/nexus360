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
        EnercareCalltrackerReasonsNotPitchAndSales::truncate();
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Pitch", "name" => "Repeat Caller", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Pitch", "name" => "Upset Customer", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Pitch", "name" => "Not decission Maker", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Pitch", "name" => "Customer already has all plans with Enercare", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Pitch", "name" => "Misroute", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Pitch", "name" => "Emergency Call", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Pitch", "name" => "Loyalty Customer (Wants to cancel)", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Pitch", "name" => "Call not completed", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Pitch", "name" => "Not eligible for coverage (Moving to condo or out of the country)", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Sale", "name" => "Unresolved Escalations", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Sale", "name" => "Customer is not interested", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Sale", "name" => "Customer has services with competitor", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Sale", "name" => "Customer cannot afford it", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Sale", "name" => "Customer hung up", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Sale", "name" => "Field complaint", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Sale", "name" => "Poor experience with Enercare", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Sale", "name" => "No show", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Sale", "name" => "Early show", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Sale", "name" => "Unsuitable appointment", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Sale", "name" => "Past priority", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Service", "type" => "Sale", "name" => "Part install", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Pitch", "name" => "Repeat Caller", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Pitch", "name" => "Upset Customer", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Pitch", "name" => "Not decission Maker", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Pitch", "name" => "Customer already has all plans with Enercare", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Pitch", "name" => "Misroute", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Pitch", "name" => "Loyalty Customer (Wants to cancel)", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Pitch", "name" => "Call not completed", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Pitch", "name" => "Not eligible for coverage (Moving to condo or out of the country)", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Pitch", "name" => "Commercial Customers", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Sale", "name" => "Unresolved Escalations", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Sale", "name" => "Media Legal Threat", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Sale", "name" => "Customer hungs up", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Sale", "name" => "Service Complaint", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::create(["lob" => "Billing", "type" => "Sale", "name" => "Poor experience with Enercare", "active" => 1 ]);
    }
}
