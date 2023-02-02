<?php

use Illuminate\Database\Seeder;
use App\EnercareTrackerSupportFacilitatorList;

class EnercareTrackerSupportFacilitatorSeeder extends Seeder
{
    /**

     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EnercareTrackerSupportFacilitatorList::truncate();
        EnercareTrackerSupportFacilitatorList::create(
            [
                'name' => 'Process',
                'list' => [
                    'Account Research' => [
                        'Account Coverage (Customer stating they have coverage that is not reflected on the account)' => [],
                        'Accounts Issues - Errors on bill' => [],
                        'Plan cancellation reason' => [],
                        'Site flashes - Ex. No end date (questions regarding whether to follow the flash or not)' => [],
                        'Tool Navigation (be specific to DEBE, Clarify, Doculink, NS, SalesForce)' => [
                            'Clarify',
                            'DEBE',
                            'Doculink',
                            'NorthStar',
                            'Outage Tracker',
                            'SalesForce',
                        ],
                        'Scenario Not Found' => [],
                    ],
                    'Product Details' => [
                        'Advantage  ,  Rental' => [],
                        'Advantage  ,  Rental (Service Experts)' => [],
                        'Loans - General questions' => [],
                        'Protection Plan' => [],
                        'Protection Plan (Service Experts)' => [],
                        'Smarter Home' => [],
                        'Warranty contract' => [],
                        'Warranty contract (Service Experts)' => [],
                        'Scenario Not Found' => [],
                    ],
                    'Sales' => [
                        'Eligibility' => [],
                        'Eligibility (Service Experts)' => [],
                        'Positioning' => [],
                        'Positioning (Service Experts)' => [],
                        'Scenario Not Found' => [],
                    ],
                    'Solution Finder Path' => [
                        'Appliances - Follow up/Escalations' => [],
                        'Customer care cases follow up (if case in open in Care queue)' => [],
                        'Lien discharges' => [],
                        'Moves - General questions' => [],
                        'Reschedule appointments for service and installs' => [],
                        'Charges on Bill' => [
                            'Back bill Charges',
                            'Protection plans billing – Multiple charges  ,  Duplicate coverage',
                            'Rental charges dispute - Rate Increase',
                            'RWH bought out and still billing',
                            'Charge Dispute',
                            'Removed Still Billing - Rwh',
                            'Removed Still Billing - Hvac',
                        ],
                        'Unsuitable Appointments' => [
                            'HVAC/RWH',
                            'Duct Cleaning',
                            'Electrical',
                            'Plumbing',
                            'Water Treatment',
                        ],
                        'Service Experts' => [],
                        'Billing Adjustment Issues' => [],
                        'Moves' => [
                            'Billed Rental For Incorrect Period'
                        ],
                        'Scenario Not Found' => [],
                        'Giftcard Inquiries' => [],
                        'Part Install Process' => [],
                        'Warning Tags' => [],
                        'Opportunities Inquiries' => [],
                        'Mobile App' => [],
                        'Plumbing Inquiries' => [],
                        'Mailling Address Changes' => [],
                        'Transfer Request' => [],
                        'Check Request' => [],
                        'Duplicate Coverage' => [],
                        'Competitor Tank Still Billing' => [],
                        'Supervisor Escalation' => [
                            'Activate new contract to book PM case' => [],
                            'Part installs process â€“ Inquiry regarding status of part order' => [],
                            'Supervisor request. - Customer asking to speak to a supervisor' => [],
                            'Scenario Not Found' => [],
                        ],
                    ],
                    'Misroute' => [
                        'Misroute' => [],
                        'Incorrect Queue' => [],
                    ],
                    'Agent Resolved On Their Own' => [
                        'Agent Resolved On Their Own' => [],
                    ],
                ]
            ]
        );
        EnercareTrackerSupportFacilitatorList::create([
            'name' => 'Behavior_Identified',
            'list' => [
                'Knowledge Gap',
                'Skill Gap',
                'Will Gap',
            ]
        ]);
        EnercareTrackerSupportFacilitatorList::create([
            'name' => 'Recommendations_to_Supervisor_,_Team_Lead_Dropdowns',
            'list' => [
                'Refresher, Training Required',
                'Coaching Recommended',
                'Additional Freeform Option for further explanation',
            ]
        ]);
    }
}
