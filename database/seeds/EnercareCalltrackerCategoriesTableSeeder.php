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
        EnercareCalltrackerCategory::create(['category' => "Billing", 'subcategory' => "Disputes", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Moves", 'subcategory' => "Will be moving", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Moves", 'subcategory' => "Has already move", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Water heater", 'subcategory' => "No hot water", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Water heater", 'subcategory' => "Insufficient hot water", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Water heater", 'subcategory' => "Leaking", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Water heater", 'subcategory' => "Noisy", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Water heater", 'subcategory' => "Dirty water/Sediment", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Water heater", 'subcategory' => "Pilot out", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Water heater", 'subcategory' => "Water pressure", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Water heater", 'subcategory' => "Water odour", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Water heater", 'subcategory' => "Other issues", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Furnace", 'subcategory' => "No heat", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Furnace", 'subcategory' => "Has heat, not warm enough", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Furnace", 'subcategory' => "Noisy", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Furnace", 'subcategory' => "Leaking", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Furnace", 'subcategory' => "Pilot out", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Furnace", 'subcategory' => "Turn off / Turn on", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Furnace", 'subcategory' => "Has heat, equipment not working correctly", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Furnace", 'subcategory' => "Humidifier issue", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Maintenance", 'subcategory' => "Heating (furnace/boiler)", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Maintenance", 'subcategory' => "Air conditioner", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Maintenance", 'subcategory' => "Fireplace", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Maintenance", 'subcategory' => "Humidifier", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Maintenance", 'subcategory' => "Pool Heater", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Maintenance", 'subcategory' => "Water heater inspections", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Maintenance", 'subcategory' => "Chargeable combo maintenance", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Maintenance", 'subcategory' => "Emergency maintenance", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Maintenance", 'subcategory' => "Heat / Energy Recovery Ventilator (HVR / ERV)", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Maintenance", 'subcategory' => "Water treament products", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Part Install", 'subcategory' => "HVAC Parts", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Part Install", 'subcategory' => "Plumbing / Electrical parts", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "HVAC Parts", 'subcategory' => "Schedule part install", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "HVAC Parts", 'subcategory' => "Inquiry regarding status of part order", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "HVAC Parts", 'subcategory' => "Appt scheduled but part has not arrived", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "HVAC Parts", 'subcategory' => "Appliance left on is now off (not working)", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "HVAC Parts", 'subcategory' => "Part delivered to wrong site", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "HVAC Parts", 'subcategory' => "Cancel part order", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "AC", 'subcategory' => "Not cooling", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "AC", 'subcategory' => "Insufficient cooling/air flow", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "AC", 'subcategory' => "Noisy", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "AC", 'subcategory' => "Leaking", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "AC", 'subcategory' => "AC freezing / Icing Up", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "AC", 'subcategory' => "Leak test required", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "AC", 'subcategory' => "Thermostat not working / adjust", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "AC", 'subcategory' => "Other issues", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "AC", 'subcategory' => "Ductless A/C issues", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Combo unit", 'subcategory' => "No hot water (With or w/o heat)", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Combo unit", 'subcategory' => "No heat, but HAS hot water", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Combo unit", 'subcategory' => "Leaking", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Combo unit", 'subcategory' => "Insufficient hot water", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Combo unit", 'subcategory' => "Has heat, not warm enough", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Combo unit", 'subcategory' => "Noisy", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Combo unit", 'subcategory' => "Dirty water/Sediment", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Combo unit", 'subcategory' => "Turn off / Turn on / going on vacation", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Combo unit", 'subcategory' => "Water pressure", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Combo unit", 'subcategory' => "Water odour", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Warning tags", 'subcategory' => "Copy of warning tag", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Warning tags", 'subcategory' => "Tag on equipment other than heat exchanger", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Warning tags", 'subcategory' => "Tag on heat exchanger", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Duct cleaning", 'subcategory' => "Qualify, Quote and Schedule (4 Step Process)", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Duct cleaning", 'subcategory' => "Features and Benefits", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Duct cleaning", 'subcategory' => "Objection Handling", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Duct cleaning", 'subcategory' => "Frequently asked questions", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Duct cleaning", 'subcategory' => "Satisfaction Guarantee", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Water treatment", 'subcategory' => "Level 1 CSRs", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Water treatment", 'subcategory' => "RWH Sales Team", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Water treatment", 'subcategory' => "Whole Home Sales Team", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "No power", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "Receptacle (power outlet) issue", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "No light", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "Switch not working", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "Breaker tripping / fuses blowing / Electrical panel", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "Customer getting shocked", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "Sparks coming from receptacle (outlet)", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "Electical installation / relocation of electrical appliance", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "Lanscape / outdoor holiday lighting", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "No power to electric furnace", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "Electric baseboard issues", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "Other issues", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Electrical", 'subcategory' => "Multiple issues", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Appliance", 'subcategory' => "Chargeable service", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Appliance", 'subcategory' => "Plan Coverage", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Fireplace", 'subcategory' => "Does not come on (no flame)", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Fireplace", 'subcategory' => "Comes on, but shuts off shortly afterwards", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Fireplace", 'subcategory' => "Noisy", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Fireplace", 'subcategory' => "Fan not working", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Fireplace", 'subcategory' => "Fan won't shut off", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Fireplace", 'subcategory' => "Main burnher flame different than before", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Fireplace", 'subcategory' => "Thermostat not working properly", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Fireplace", 'subcategory' => "Turn off / Turn on", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Fireplace", 'subcategory' => "Fireplace heating, but not working correctly", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Fireplace", 'subcategory' => "Glass is dirty or requires other maintenance", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Plumbing", 'subcategory' => "Drain issue", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Plumbing", 'subcategory' => "Pipe issue", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Plumbing", 'subcategory' => "Toilet issue", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Plumbing", 'subcategory' => "Faucet issue", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Plumbing", 'subcategory' => "Valve issue", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Plumbing", 'subcategory' => "Multiple issues", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Emergency Calls", 'subcategory' => "Carbon monoxide detector is alarming", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Emergency Calls", 'subcategory' => "Cracked / Broken / Separated Vent Pipe", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Emergency Calls", 'subcategory' => "Delayed Ignition", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Emergency Calls", 'subcategory' => "Equipment Overheating", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Emergency Calls", 'subcategory' => "Fire / Explosion", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Emergency Calls", 'subcategory' => "Gas Smell / Fumes", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Emergency Calls", 'subcategory' => "Main drain issues causing damage to the property", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Emergency Calls", 'subcategory' => "RWH leaking causing damage to the property", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Emergency Calls", 'subcategory' => "Warning Tags", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Protection Plan Inhformation / Marketing", 'subcategory' => "Protection Plan / Employee-Family/Friends Offers", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Protection Plan Inhformation / Marketing", 'subcategory' => "Features and Benefits", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Protection Plan Inhformation / Marketing", 'subcategory' => "Competitor Protection Plans / Activity", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Protection Plan Inhformation / Marketing", 'subcategory' => "Job Aids", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Protection Plan Inhformation / Marketing", 'subcategory' => "Policies and Procedures", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Protection Plan Inhformation / Marketing", 'subcategory' => "Terms and Conditions", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Protection Plan Inhformation / Marketing", 'subcategory' => "Updating / remocing cx information related to marketing", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Protection Plan Inhformation / Marketing", 'subcategory' => "Duplicate Coverage FAQs", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Protection Plan Inhformation / Marketing", 'subcategory' => "Protection Plan Cancellations", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Protection Plan Inhformation / Marketing", 'subcategory' => "Adding the Sale", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Appointment issues", 'subcategory' => "Early show", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Appointment issues", 'subcategory' => "Past prority / no show", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Appointment issues", 'subcategory' => "Unsuitable appointment", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Call not completed", 'subcategory' => "Ghost call", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Call not completed", 'subcategory' => "Call dropped", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Billing", 'subcategory' => "Moves", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Billing", 'subcategory' => "Billing explanation", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Billing", 'subcategory' => "Duplicate Charges", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Billing", 'subcategory' => "Assumption agreement", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Billing", 'subcategory' => "Charge Dispute", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Billing", 'subcategory' => "Back billing charges", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Billing", 'subcategory' => "Leakage bill", 'active' => 1]);
        EnercareCalltrackerCategory::create(['category' => "Billing", 'subcategory' => "OBA Disputes", 'active' => 1]);
    }
}
