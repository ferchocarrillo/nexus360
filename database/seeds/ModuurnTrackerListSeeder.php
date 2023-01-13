<?php

use App\ModuurnTrackerList;
use Illuminate\Database\Seeder;


class ModuurnTrackerListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModuurnTrackerList::truncate();
        ModuurnTrackerList::create([
            'name' => 'ReasonNotSchedule',
            'list' => [
                'Left vm with moduurn #',
                'Upset customer',
                'Not Decision Maker',
                'Not Decision Maker but email sent, moduurn # given',
                'Rejected offer including moduurn # & email ',
                'Hung up',
                'No answer or VM/Fax tone/Left vm',
            ]
        ]);
        ModuurnTrackerList::create([
            'name' => 'Type',
            'list' => [
                'Schedule',
                'Reschedule',
            ]
        ]);
        ModuurnTrackerList::create([
            'name' => 'Expert',
            'list' => [
                'Jennifer',
                'Jose',
            ]
        ]);
        ModuurnTrackerList::create([
            'name' => 'Country',
            'list' => [
                'USA' => [
                    'EST' => [
                        'CT',
                        'DE',
                        'DC',
                        'FL',
                        'GA',
                        'ME',
                        'MA',
                        'NH',
                        'NJ',
                        'NY',
                        'NC',
                        'PA',
                        'RI',
                        'SC',
                        'VT',
                        'VA',
                        'WV',
                    ],
                    'EST/CST' => [
                        'IN',
                        'KY',
                        'MD',
                        'MI',
                        'OH',
                        'TN'
                    ],
                    'MST' => [
                        'AZ',
                        'CO',
                        'ID',
                        'MT',
                        'NM',
                        'UT',
                        'WY'
                    ],
                    'MST/CST' => [
                        'NE',
                        'ND',
                        'SD',
                        'NE',
                        'ND',
                        'SD'
                    ],
                    'PST' => [
                        'CA',
                        'NV',
                        'OR',
                        'WA'
                    ],
                    'CST' => [
                        'AL',
                        'AR',
                        'IL',
                        'IA',
                        'KS',
                        'LA',
                        'MN',
                        'MS',
                        'MO',
                        'OK',
                        'TX',
                        'WI'
                    ],
                    'AKST' => [
                        'AK'
                    ],
                    'HST' => [
                        'HI'
                    ],
                ],
                'Canada' => [
                    'EST' => [
                        'ON',
                    ],
                    'MST' => [
                        'AB',
                    ],
                    'PST' => [
                        'BC',
                        'TY',
                    ],
                    'CST' => [
                        'MB',
                        'SK',
                    ],
                    'NL' => [
                        'NL',
                    ],
                    'AST' => [
                        'NB',
                        'PE',
                        'NS',
                    ],
                ],
            ]
        ]);
    }
}
