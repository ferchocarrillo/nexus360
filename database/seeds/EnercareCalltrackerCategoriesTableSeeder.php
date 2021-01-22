<?php

use App\EnercareCalltrackerCategory;
use Illuminate\Database\Seeder;

class EnercareCalltrackerCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        EnercareCalltrackerCategory::truncate();
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "AC", "subcategory" => "Not Cooling", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "AC", "subcategory" => "Insufficient cooling", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "AC", "subcategory" => "AC Freezing up", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "AC", "subcategory" => "Leak test", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "AC", "subcategory" => "Thermostat not working", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "AC", "subcategory" => "Other issues", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "AC", "subcategory" => "Noisy", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "AC", "subcategory" => "Unit Relocation (Opportunity)", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "AC", "subcategory" => "Leaking", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Appliances", "subcategory" => "Chargeable Service", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Appliances", "subcategory" => "Follow-ups/Escalations", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Appliances", "subcategory" => "Plan Coverage", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Appointment Issue", "subcategory" => "No show", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Appointment Issue", "subcategory" => "Early show", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Appointment Issue", "subcategory" => "Unsuitable appointment", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Appointment Issue", "subcategory" => "Past Priority", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Call Not Completed", "subcategory" => "Ghost call", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Call Not Completed", "subcategory" => "Call dropped", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Combo Unit", "subcategory" => "Insufficient hot water", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Combo Unit", "subcategory" => "Leaking", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Combo Unit", "subcategory" => "Dirty water", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Combo Unit", "subcategory" => "Water pressure", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Combo Unit", "subcategory" => "Water odour", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Combo Unit", "subcategory" => "Not warm enough", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Combo Unit", "subcategory" => "No hot water", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Combo Unit", "subcategory" => "Water but no heat", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Combo Unit", "subcategory" => "Turn off/Turn on", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Combo Unit", "subcategory" => "Other Issues", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Duct Cleaning", "subcategory" => "Qualify, Quote & Schedule", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Duct Cleaning", "subcategory" => "Objection handling", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Duct Cleaning", "subcategory" => "Frequently asked questions", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Duct Cleaning", "subcategory" => "Satisfaction guarantee", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Duct Cleaning", "subcategory" => "Cancel/Reschedule Duct Cleaning", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Electrical", "subcategory" => "Other issues", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Electrical", "subcategory" => "No power", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Electrical", "subcategory" => "Receptacle", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Electrical", "subcategory" => "No light", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Electrical", "subcategory" => "Switch not working", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Electrical", "subcategory" => "Electrical Panel issues", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Electrical", "subcategory" => "Electrical Installation/Quote", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Electrical", "subcategory" => "Multiple Issues", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Emergency Calls", "subcategory" => "Carbon monoxide dectector", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Emergency Calls", "subcategory" => "Cracked/Broken/Separated pipe", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Emergency Calls", "subcategory" => "Delayed ignition", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Emergency Calls", "subcategory" => "Equipment overheating", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Emergency Calls", "subcategory" => "Fire/explosion", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Emergency Calls", "subcategory" => "Gas smell / Fumes", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Emergency Calls", "subcategory" => "Main drain issues causing property damage", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Emergency Calls", "subcategory" => "RWH leak causing property damage", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Fireplace", "subcategory" => "Noisy", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Fireplace", "subcategory" => "Turn off/on", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Fireplace", "subcategory" => "Does not come one (no flame)", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Fireplace", "subcategory" => "Comes on, but shuts off shortly afterwards", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Fireplace", "subcategory" => "Fan not working", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Fireplace", "subcategory" => "Fan won't shut off", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Fireplace", "subcategory" => "Burner flame different than before", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Fireplace", "subcategory" => "Therostat not working properly", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Fireplace", "subcategory" => "Heat, but now working correctly", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Fireplace", "subcategory" => "Glass is dirty or require mainteinance", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Fireplace", "subcategory" => "Other Issues", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Furnace", "subcategory" => "Pilot out", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Furnace", "subcategory" => "No heat", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Furnace", "subcategory" => "Heat, but not working correctly", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Furnace", "subcategory" => "Humidifier issue", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Furnace", "subcategory" => "Noisy", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Furnace", "subcategory" => "Thermostat Issues", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Furnace", "subcategory" => "Filter Request", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Furnace", "subcategory" => "Leaking", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Furnace", "subcategory" => "MagicPack", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Parts Install", "subcategory" => "Schedule part install", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Parts Install", "subcategory" => "Inquiry regarding status of part order", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Parts Install", "subcategory" => "Appt scheduled but part not arrived", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Parts Install", "subcategory" => "Appliance left On is now Off", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Parts Install", "subcategory" => "Part delivered to wrong site", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Parts Install", "subcategory" => "Cancel part order", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Parts Install", "subcategory" => "Installation of Quoted Parts", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Parts Install", "subcategory" => "Other Issues", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Maintenance", "subcategory" => "AC", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Maintenance", "subcategory" => "FURNACE", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Maintenance", "subcategory" => "FIREPLACE", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Maintenance", "subcategory" => "HUMIDIFIER", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Maintenance", "subcategory" => "WATER HEATER INSPECTIONS", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Maintenance", "subcategory" => "OTHER", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Misroutes", "subcategory" => "Billing", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Misroutes", "subcategory" => "EPCR Service-Sales-Install", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Misroutes", "subcategory" => "Smarter Home", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Misroutes", "subcategory" => "Whole Home Sales", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Misroutes", "subcategory" => "Commercial", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Misroutes", "subcategory" => "RWH Sales", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Opportunities", "subcategory" => "CONNECT/DISCONNECT APPLIANCE", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Opportunities", "subcategory" => "RELOCATION", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Opportunities", "subcategory" => "HUMIDIFIER", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Opportunities", "subcategory" => "HVAC SALES - AFTER HOURS", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Opportunities", "subcategory" => "VENTING/DUCT WORK/SUPPLY LINES", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Plumbing", "subcategory" => "Hi Velocity Leak PB60", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Plumbing", "subcategory" => "1 Toilet at home PB50", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Plumbing", "subcategory" => "Main Drain Back Up PB25", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Plumbing", "subcategory" => "Possible Main Drain", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Plumbing", "subcategory" => "Drain Back Up", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Plumbing", "subcategory" => "Dripping/Leak Pipe", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Plumbing", "subcategory" => "Toilet Issues", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Plumbing", "subcategory" => "Below Grade Quote", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Plumbing", "subcategory" => "Mixing Valve", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Plumbing", "subcategory" => "Installation Requests", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Plumbing", "subcategory" => "Complete work Quoted by Enercare Plumber", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Warning Tags", "subcategory" => "Copy of warning tag", "service_call" => 0, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Warning Tags", "subcategory" => "Tag on equipment other than heat exchanger", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Warning Tags", "subcategory" => "Tag on heat exchanger", "service_call" => 1, "active" => 1 ]);
        
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Water Heater", "subcategory" => "No Hot Water", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Water Heater", "subcategory" => "Insufficient Hot Water", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Water Heater", "subcategory" => "Noisy", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Water Heater", "subcategory" => "Dirty Water", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Water Heater", "subcategory" => "Pilot Out", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Water Heater", "subcategory" => "Water Odour", "service_call" => 1, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Service", "category" => "Water Heater", "subcategory" => "Other", "service_call" => 1, "active" => 1 ]);
        
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Protection Plan Billing", "subcategory" => "Contracts Corrections and Billing Frequency Changes", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Protection Plan Billing", "subcategory" => "Multiple charges for the same product/duplicate coverage", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Protection Plan Billing", "subcategory" => "Account Settlement Charges and Back Billing", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Protection Plan Billing", "subcategory" => "Protection Plan Charges Dispute", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Protection Plan Billing", "subcategory" => "Customer Billed After Contract Cancellation", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Protection Plan Billing", "subcategory" => "Back-Bill Charges", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Rental Billing", "subcategory" => "Copy of Agreement Request", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Rental Billing", "subcategory" => "Removed and Still Billing", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Rental Billing", "subcategory" => "Competitor Tank Still Billing", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Rental Billing", "subcategory" => "Not received offer of 3 months free rent", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Rental Billing", "subcategory" => "Billed incorrectly for monthly charges", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Rental Billing", "subcategory" => "RWH bought out and still billing", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Rental Billing", "subcategory" => "HVAC Offers not applied", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Rental Billing", "subcategory" => "Rental Charges Dispute", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Rental Billing", "subcategory" => "Back-Bill Charges", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Rental Billing", "subcategory" => "MasterCard Escalation", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Service Disputes", "subcategory" => "Installation Charges", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Service Disputes", "subcategory" => "Service Call / DC Charges", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Service Disputes", "subcategory" => "Dispute on Service Calls or Technicians", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Service Disputes", "subcategory" => "Property Damage complaints", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Account Issues", "subcategory" => "Errors on Bill", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Account Issues", "subcategory" => "Duplicate Sites", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Account Issues", "subcategory" => "DEBE Account in \"error\" or \"inactive\"", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Account Issues", "subcategory" => "Cheque Request for credit applied to bill", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Account Issues", "subcategory" => "E-Billing", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Moves", "subcategory" => "Customer to Customer Move", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Moves", "subcategory" => "Builder to Customer Move", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Moves", "subcategory" => "LL/TT Move", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Moves", "subcategory" => "Delaer Moves", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Moves", "subcategory" => "Incorrect CX Billing", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Moves", "subcategory" => "Reverse a Move", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Payments", "subcategory" => "Payment Inquiry", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Payments", "subcategory" => "PAP Removal", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Payments", "subcategory" => "PAP Information and inquiry on procedure", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Liens/Loans", "subcategory" => "Basic information about the loan", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Liens/Loans", "subcategory" => "Liens Removal", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Liens/Loans", "subcategory" => "Needs to send information for Lien", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "Connections", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "EGD", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "Ghost Calls", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "Chubb", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "ECFP/SNAP/CityFinancial", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "Collections", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "Level 1 CSRs", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "Claims", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "Customer Care", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "Loyalty", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "Sales", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "Saves", "service_call" => null, "active" => 1 ]);
        EnercareCalltrackerCategory::create(["lob" => "Billing", "category" => "Misroutes", "subcategory" => "WHST", "service_call" => null, "active" => 1 ]);

    }
}
