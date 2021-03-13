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
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Pitch", "name" => "Repeat Caller", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Pitch", "name" => "Upset Customer", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Pitch", "name" => "Not decission Maker", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Pitch", "name" => "Customer already has all plans with Enercare", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Pitch", "name" => "Misroute", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Pitch", "name" => "Emergency Call", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Pitch", "name" => "Loyalty Customer (Wants to cancel)", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Pitch", "name" => "Call not completed", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Pitch", "name" => "Not eligible for coverage (Moving to condo or out of the country)", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Sale", "name" => "Unresolved Escalations", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Sale", "name" => "Customer is not interested", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Sale", "name" => "Customer has services with competitor", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Sale", "name" => "Customer cannot afford it", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Sale", "name" => "Customer hung up", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Sale", "name" => "Field complaint", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Sale", "name" => "Poor experience with Enercare", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Sale", "name" => "No show", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Sale", "name" => "Early show", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Sale", "name" => "Unsuitable appointment", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Sale", "name" => "Past priority", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Service", "type" => "Sale", "name" => "Part install", "active" => 1 ]);
        
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Pitch", "name" => "Repeat Caller", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Pitch", "name" => "Upset Customer", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Pitch", "name" => "Not decission Maker", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Pitch", "name" => "Customer already has all plans with Enercare", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Pitch", "name" => "Misroute", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Pitch", "name" => "Loyalty Customer (Wants to cancel)", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Pitch", "name" => "Call not completed", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Pitch", "name" => "Not eligible for coverage (Moving to condo or out of the country)", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Pitch", "name" => "Commercial Customers", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Sale", "name" => "Unresolved Escalations", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Sale", "name" => "Media Legal Threat", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Sale", "name" => "Customer hungs up", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Sale", "name" => "Service Complaint", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Billing", "type" => "Sale", "name" => "Poor experience with Enercare", "active" => 1 ]);
        
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "OBA", "type" => "Pitch", "name" => "Upset customer", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "OBA", "type" => "Pitch", "name" => "Not Decision maker", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "OBA", "type" => "Pitch", "name" => "Misroute", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "OBA", "type" => "Pitch", "name" => "Customer wants to cancel", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "OBA", "type" => "Pitch", "name" => "Not eligible for coverage (moving to condo or out of the country)", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "OBA", "type" => "Pitch", "name" => "Commercial Customer", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "OBA", "type" => "Sale", "name" => "Customer rejected offer", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "OBA", "type" => "Sale", "name" => "Poor experience with Enercare", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "OBA", "type" => "Sale", "name" => "Customer hungs up", "active" => 1 ]);
        
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Pitch", "name" => "Upset Customer", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Pitch", "name" => "Not Decision Maker", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Pitch", "name" => "Misroute", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Pitch", "name" => "Customer Wants to Cancel", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Pitch", "name" => "Not eligible for coverage (moving to condo or out of the country)", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Pitch", "name" => "Commercial Customer", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Pitch", "name" => "Customer rejected offer", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Pitch", "name" => "Poor experience with Enercare", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Pitch", "name" => "Customer Hungs Up", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Pitch", "name" => "Customer not Interested", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Pitch", "name" => "Lack Of Trust", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Sale", "name" => "Customer is not interested", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Sale", "name" => "Poor experience with Enercare", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Sale", "name" => "Unresolved Escalations", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Sale", "name" => "Customer rejected offer", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Sale", "name" => "Lack Of Trust", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Sale", "name" => "Customer cannot afford it", "active" => 1 ]);
        EnercareCalltrackerReasonsNotPitchAndSales::firstOrCreate(["lob" => "Offline", "type" => "Sale", "name" => "Customer hung up", "active" => 1 ]);
    }
}
