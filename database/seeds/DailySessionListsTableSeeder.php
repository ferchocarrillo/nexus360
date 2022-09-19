<?php

use App\DailySessionList;
use Illuminate\Database\Seeder;

class DailySessionListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DailySessionList::truncate();
        DailySessionList::create([
            'name' => 'type',
            'list' => [
                'Client Escalation',
                'Coaching',
                'Short Call',
                'Feedback'
            ]
        ]);

        DailySessionList::create([
            'name' => 'tactic',
            'list' => [
                'Skill Transfer',
                'Side by Side',
                'Team Huddle',
                'DFM',
                'Setting Expectation',
                'Accountability',
                'Hot Lap',
                'On The Fly',
                'Rapid Fire',
                'Team Meeting',
                'GTKY',
                'Hot Lap Constructive',
                'Hot Lap Corrective'
            ]
        ]);

        DailySessionList::create([
            'name' => 'behaviour',
            'list' => [
                "Greeting",
                "Empathy",
                "Authentication",
                "Transition",
                "Tool Usage",
                "Resolution",
                "Discovery Questions",
                "Rebuttal",
                "Recap",
                "Closing",
                "Mandatory Statements",
                "Perzonalized Offer",
            ]
        ]);

        DailySessionList::create([
            'name' => "metric",
            'list' => [
                "N/A",
                "Sales",
                "QA",
                "AHT",
                "Attendance",
                "CPH",
                "Hold",
                "Error Log",
                "FCR",
                "NPS",
                "C-SAT",
                "Compliance",
                "Save Rate",
                "Reject Rate",
                "Denied Upfront",
                "Denied with Cost",
                "Occupancy",
                "Proposals",
                "Booking Conversion",
            ]
        ]);

        DailySessionList::create([
            'name' => "documented",
            'list' => [
                "Bamboo",
                "Outlook Email",
                "Scorebuddy",
            ]
        ]);

        DailySessionList::create([
            'name' => 'root_causes',
            'list' => [
                ["root_cause" => "Knowledge", "educational_tool" => "Visual"],
                ["root_cause" => "Knowledge", "educational_tool" => "Demo Call"],
                ["root_cause" => "Knowledge", "educational_tool" => "Fast Ball Quiz"],
                ["root_cause" => "Knowledge", "educational_tool" => "Quiz"],
                ["root_cause" => "Skills", "educational_tool" => "Coach call"],
                ["root_cause" => "Skills", "educational_tool" => "Debate/Discuss"],
                ["root_cause" => "Skills", "educational_tool" => "Model Tape"],
                ["root_cause" => "Skills", "educational_tool" => "Self Tape"],
                ["root_cause" => "Skills", "educational_tool" => "Self Tape VS Model Tape"],
                ["root_cause" => "Skills", "educational_tool" => "Self Tape vs Evaluation"],
                ["root_cause" => "Skills", "educational_tool" => "Role Play"],
                ["root_cause" => "Environment", "educational_tool" => "Analogy"],
                ["root_cause" => "Environment", "educational_tool" => "Debate/Discuss"],
                ["root_cause" => "Environment", "educational_tool" => "Positive"],
                ["root_cause" => "Environment", "educational_tool" => "Sel Expectation"],
                ["root_cause" => "Environment", "educational_tool" => "Set Goal"],
                ["root_cause" => "Motivation", "educational_tool" => "Positive"],
                ["root_cause" => "Motivation", "educational_tool" => "Analogy"],
                ["root_cause" => "Motivation", "educational_tool" => "Debate/Discuss"],
                ["root_cause" => "Motivation", "educational_tool" => "Set Goal"],
                ["root_cause" => "Motivation", "educational_tool" => "Set Expectation"],
                ["root_cause" => "Motivation", "educational_tool" => "Self Tape vs Self Tape"],
                ["root_cause" => "Feedback", "educational_tool" => "Debate/Discuss"],
                ["root_cause" => "Feedback", "educational_tool" => "Positive"],
            ]
        ]);
    }
}
