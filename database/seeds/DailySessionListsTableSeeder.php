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
                'Feedback',
                'Daily QA Review',
                'Dispatch E-mails'
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
                "Offer",
                "Rebuttal",
                "Recap",
                "Closing",
                "Mandatory Statements",
                "Perzonalized Offer",
                "BA",
                "BST Cases",
                "NCB",
                "NPS",
                "Unsuitable App",
                "Ownership",
                "Account not created",
                "Advantage Left Off Email",
                "Afterhours US Dispatch Left off email",
                "Afterhours US Dispatch/187/Elite TL's Left off email",
                "Center is overbooked",
                "Center Left Off Email",
                "Customer in wrong center",
                "Customer Info Left Off Email / Missing Information",
                "Daily Quality Check Call",
                "Duplicate Ticket/Account Creation",
                "Email subject line",
                "Emailed Incorrect Team",
                "GM Left off Email / Incorrect GM Email",
                "Incorrect Call Resolution",
                "Incorrect call type",
                "Incorrect department",
                "Incorrect Hold Procedure/Call disconnected with no Call back registered",
                "Incorrect hour and ticket",
                "Incorrect hour/date and ticket",
                "Incorrect Info On Email",
                "Incorrect problem code selected",
                "Incorrect Process",
                "Incorrect tech assigned",
                "Incorrect Ticket Booking",
                "Missing Information",
                "Missing phone number",
                "No Call Flow Followed Properly/Mislead customer",
                "No notes on account",
                "No notes on ticket",
                "No Ticket Scheduled",
                "Not in Service Area",
                "Not service provided in center",
                "Not Updated/Correct info on Account",
                "Rudeness / Incorrect agent behaviour",
                "Ticket Not Updated",
                "Wrong call/ticket clasification",
                "Wrong Email Distribution List Used",
                "Wrong Personnel on Email",
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
                "OBA QA Process",
                "FCR",
                "NPS",
                "C-SAT",
                "Compliance",
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
