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
                "AWRL Current Credits"=>[
                    "fields"=>[
                        "cus_id"=>true,
                        "customer_name"=>true,
                        "spreadsheet"=>true,
                        "view"=>false,
                        "status"=>true,
                        "enr_number"=>true,
                        "agreement_classification"=>true,
                        "additional_notes"=>true,
                    ]
                ],
                "Bulk refunds"=>[
                    "fields"=>[
                        "cus_id"=>true,
                        "customer_name"=>false,
                        "spreadsheet"=>false,
                        "view"=>false,
                        "status"=>false,
                        "enr_number"=>false,
                        "agreement_classification"=>false,
                        "additional_notes"=>false,
                    ]
                ],
                "Checklist"=>[
                    "fields"=>[
                        "cus_id"=>false,
                        "customer_name"=>false,
                        "spreadsheet"=>false,
                        "view"=>true,
                        "status"=>true,
                        "enr_number"=>true,
                        "agreement_classification"=>true,
                        "additional_notes"=>true,
                    ]
                ],
                "Journal Entries"=>[
                    "fields"=>[
                        "cus_id"=>false,
                        "customer_name"=>false,
                        "spreadsheet"=>false,
                        "view"=>false,
                        "status"=>false,
                        "enr_number"=>false,
                        "agreement_classification"=>false,
                        "additional_notes"=>false,
                    ],    
                ],
                "Problem Payment Issue"=>[
                    "fields"=>[
                        "cus_id"=>false,
                        "customer_name"=>false,
                        "spreadsheet"=>false,
                        "view"=>false,
                        "status"=>false,
                        "enr_number"=>false,
                        "agreement_classification"=>false,
                        "additional_notes"=>false,
                    ],    
                ],
                "Service Fees"=>[
                    "fields"=>[
                        "cus_id"=>false,
                        "customer_name"=>false,
                        "spreadsheet"=>false,
                        "view"=>false,
                        "status"=>false,
                        "enr_number"=>false,
                        "agreement_classification"=>false,
                        "additional_notes"=>false,
                    ],    
                ],
                "Settlements"=>[
                    "fields"=>[
                        "cus_id"=>false,
                        "customer_name"=>false,
                        "spreadsheet"=>false,
                        "view"=>false,
                        "status"=>false,
                        "enr_number"=>false,
                        "agreement_classification"=>false,
                        "additional_notes"=>false,
                    ],    
                ],
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
                "Solved"=>["gotoENR"=>1],
                "ENR not in AX"=>["gotoENR"=>1],
                "Not Solved"=>["gotoENR"=>1],
            ]
        ]);

        AmericanWaterBoTrackerList::create([
            'name' => 'agreement_classifications',
            'list' => [
                'AWR Cancelled',
                'Re-Enrollment',
                'Renewal',
                'New'
            ]
        ]);

        AmericanWaterBoTrackerList::create([
            'name' => 'views',
            'list' => [
                'Active ENR w/ End Date in Past',
                'Active ENR w/ Incorrect Order Source',
                'Active ENR w/ Invalid ENR Status Reason',
                'Active ENR w/o Auto Renew Populated',
                'Active ENR, DoNotAuto w Pending/Authorized Pmt Authorization',
                'Cancel Off-Bill w/o Cancel Date',
                'Cancelled w/ Invalid ENR Status Reason',
                'Commercial Acct w. IHPP',
                'Closed-Invalid sent to AX',
                'Suspended w/ Invalid Payment Method',
                'Suspended w/o Cancellation Date',
                'Suspended w Cancel Date in Past',
                'Suspended w/o Suspended Date',
                'Missing Payment Report',
                'AutoVoid Payment Authorization FallOut',
            ]
        ]);
    }
}
