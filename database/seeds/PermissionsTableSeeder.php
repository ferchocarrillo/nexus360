<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission::truncate();

        Permission::firstOrCreate([
            'name'          => 'Login Without Masterfile',
            'slug'          => 'login.withoutmf',
            'description'   => 'Login Without Masterfile',
        ]);


        // Users
        Permission::firstOrCreate([
            'name'          => 'Browse Users',
            'slug'          => 'users.index',
            'description'   => 'List and browse all system users',
        ]);
        Permission::firstOrCreate([
            'name'          => 'View user detail',
            'slug'          => 'users.show',
            'description'   => 'View in detail a system user',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Edit Users',
            'slug'          => 'users.edit',
            'description'   => 'Edit any data of a system user',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Delete User',
            'slug'          => 'users.destroy',
            'description'   => 'Remove user from system',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Create User',
            'slug'          => 'users.create',
            'description'   => 'Create user in the system',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Upload Users',
            'slug'          => 'users.upload',
            'description'   => 'Upload users in the system',
        ]);

        // Roles
        Permission::firstOrCreate([
            'name'          => 'Browse Roles',
            'slug'          => 'roles.index',
            'description'   => 'List and browse all system roles',
        ]);
        Permission::firstOrCreate([
            'name'          => 'View role detail',
            'slug'          => 'roles.show',
            'description'   => 'View in detail a system role',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Edit roles',
            'slug'          => 'roles.edit',
            'description'   => 'Edit any data of a system role',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Delete role',
            'slug'          => 'roles.destroy',
            'description'   => 'Remove role from system',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Create role',
            'slug'          => 'roles.create',
            'description'   => 'Create role in the system',
        ]);

        // Agent Activity
        Permission::firstOrCreate([
            'name'          => 'Agent activity',
            'slug'          => 'agentactivity.index',
            'description'   => 'View agent activity',
        ]);

        // Agent Activity supervisor
        Permission::firstOrCreate([
            'name'          => 'Agent activity Supervisor',
            'slug'          => 'agentactivity.supervisor',
            'description'   => 'View activity of my agents',
        ]);

        // Agent Activity Report
        Permission::firstOrCreate([
            'name'          => 'Agent activity Report',
            'slug'          => 'agentactivity.report',
            'description'   => 'Download Report Agent Activity',
        ]);

        // CGM
        Permission::firstOrCreate([
            'name'          => 'CGM Appointment Tracker',
            'slug'          => 'cgm.appointmenttracker',
            'description'   => 'Appointment Tracker',
        ]);
        Permission::firstOrCreate([
            'name'          => 'CGM Upload List',
            'slug'          => 'cgm.uploadlist',
            'description'   => 'Upload List',
        ]);
        Permission::firstOrCreate([
            'name'          => 'CGM Download List',
            'slug'          => 'cgm.downloadlists',
            'description'   => 'Download List',
        ]);
        Permission::firstOrCreate([
            'name'          => 'CGM Report Appointment',
            'slug'          => 'cgm.reports',
            'description'   => 'Report Appointment',
        ]);

        Permission::firstOrCreate([
            'name'          => 'CGM QA',
            'slug'          => 'cgm.qa',
            'description'   => 'Quality Analyst',
        ]);

        // Enercare

        Permission::firstOrCreate([
            'name'          => 'Enercare',
            'slug'          => 'enercare',
            'description'   => 'Enercare Campaign',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Enercare Call Tracker',
            'slug'          => 'enercare.calltracker',
            'description'   => 'Enercare Call Tracker',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Enercare Reports',
            'slug'          => 'enercare.reports',
            'description'   => 'Enercare Reports',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Enercare Report Sales',
            'slug'          => 'enercare.reportsales',
            'description'   => 'Enercare Report Sales',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Enercare Report Call Tracker',
            'slug'          => 'enercare.reportcalltracker',
            'description'   => 'Enercare Report Call Tracker',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Enercare Report KPIs',
            'slug'          => 'enercare.reportkpis',
            'description'   => 'Enercare Report KPIs',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Enercare Uploads',
            'slug'          => 'enercare.uploads',
            'description'   => 'Enercare Uploads',
        ]);
        Permission::firstOrCreate([
            'name'          => 'Enercare Upload AgentPerformance',
            'slug'          => 'enercare.uploadagentperformance',
            'description'   => 'Enercare Upload AgentPerformance',
        ]);

        Permission::firstOrCreate([
            'name'          => 'Enercare Sales Ranking',
            'slug'          => 'enercare.salesranking',
            'description'   => 'Enercare Sales Rankings',
        ]);

        // SERVICE EXPERTS

        Permission::firstOrCreate([
            'name'          => 'Service Experts',
            'slug'          => 'serviceexperts',
            'description'   => 'Service Experts Campaign'
        ]);
        Permission::firstOrCreate([
            'name'          => 'Service Experts Files',
            'slug'          => 'serviceexperts.files',
            'description'   => 'Service Experts View Files'
        ]);
        Permission::firstOrCreate([
            'name'          => 'Service Experts Upload Files',
            'slug'          => 'serviceexperts.filesupload',
            'description'   => 'Service Experts Upload Files'
        ]);
        Permission::firstOrCreate([
            'name'          => 'Service Experts Delete Files',
            'slug'          => 'serviceexperts.filesdelete',
            'description'   => 'Service Experts Delete Files'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Kaizen',
            'slug'          => 'kaizen',
            'description'   => 'Kaizen'
        ]);
        Permission::firstOrCreate([
            'name'          => 'Kaizen Admin',
            'slug'          => 'kaizen.admin',
            'description'   => 'Kaizen Admin'
        ]);
        Permission::firstOrCreate([
            'name'          => 'Kaizen Team',
            'slug'          => 'kaizen.team',
            'description'   => 'Kaizen Team'
        ]);
        Permission::firstOrCreate([
            'name'          => 'Kaizen Email',
            'slug'          => 'kaizen.email',
            'description'   => 'Kaizen Team'
        ]);
        Permission::firstOrCreate([
            'name'          => 'Kaizen Operations',
            'slug'          => 'kaizen.operations',
            'description'   => 'Kaizen Operations'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Reminders',
            'slug'          => 'reminders',
            'description'   => 'Create Reminders'
        ]);

        Permission::firstOrCreate([
            'name'          => "Pandora's Box",
            'slug'          => "pandorasbox",
            'description'   => "Pandora's Box"
        ]);

        Permission::firstOrCreate([
            'name'          => "Admin Logs",
            'slug'          => "adminlogs",
            'description'   => "Admin Logs"
        ]);

        // Payroll Novelties

        Permission::firstOrCreate([
            'name'          => "Payroll Novelty",
            'slug'          => "payrollnovelty",
            'description'   => "Payroll Novelty",
        ]);

        Permission::firstOrCreate([
            'name'          => "Payroll Novelty Admin",
            'slug'          => "payrollnovelty.admin",
            'description'   => "Payroll Novelty Admin",
        ]);

        Permission::firstOrCreate([
            'name'          => "Payroll Novelty Reports",
            'slug'          => "payrollnovelty.reports",
            'description'   => "Payroll Novelty Reports",
        ]);

        Permission::firstOrCreate([
            'name'          => "Payroll Novelty Reports Novelties",
            'slug'          => "payrollnovelty.reports.novelties",
            'description'   => "Payroll Novelty Reports Novelties",
        ]);

        Permission::firstOrCreate([
            'name'          => "Payroll Novelty Reports Novelties RRHH",
            'slug'          => "payrollnovelty.reports.noveltiesrrhh",
            'description'   => "Payroll Novelty Reports Novelties RRHH",
        ]);

        Permission::firstOrCreate([
            'name'          => "Payroll Novelty Reports General",
            'slug'          => "payrollnovelty.reports.general",
            'description'   => "Payroll Novelty Reports General",
        ]);

        Permission::firstOrCreate([
            'name'          => "Payroll Novelty Flat File",
            'slug'          => "payrollnovelty.flatfile",
            'description'   => "Payroll Novelty Flat File",
        ]);

        Permission::firstOrCreate([
            'name'          => "Payroll Novelty Delete Novelties",
            'slug'          => "payrollnovelty.delete",
            'description'   => "Payroll Novelty Delete Novelties",
        ]);

        Permission::firstOrCreate([
            'name'          => "American Water",
            'slug'          => "americanwater",
            'description'   => "American Water",
        ]);

        Permission::firstOrCreate([
            'name'          => "American Water BO Tracker",
            'slug'          => "americanwater.botracker",
            'description'   => "American Water BO Tracker",
        ]);

        Permission::firstOrCreate([
            'name'          => "American Water BO Tracker Reports",
            'slug'          => "americanwater.botracker.reports",
            'description'   => "American Water BO Tracker Reports",
        ]);

        Permission::firstOrCreate([
            'name'          => "American Water BO Tracker Report General",
            'slug'          => "americanwater.botracker.reports.general",
            'description'   => "American Water BO Tracker Report General",
        ]);

        Permission::firstOrCreate([
            'name'          => "MasterFile",
            'slug'          => "masterfile",
            'description'   => "MasterFile"
        ]);

        Permission::firstOrCreate([
            'name'          => "MasterFile WFH",
            'slug'          => "masterfile.wfh",
            'description'   => "MasterFile WFH"
        ]);

        // Daily Sessions

        Permission::firstOrCreate([
            'name'          => "Daily Sessions",
            'slug'          => "dailysessions",
            'description'   => "Show and Acknowledge Daily Sessions"
        ]);

        Permission::firstOrCreate([
            'name'          => "Daily Sessions Create",
            'slug'          => "dailysessions.create",
            'description'   => "Create Daily Sessions"
        ]);

        Permission::firstOrCreate([
            'name'          => "Daily Sessions Filters",
            'slug'          => "dailysessions.filters",
            'description'   => "Filter list of Daily Sessions"
        ]);

        Permission::firstOrCreate([
            'name'          => "Daily Sessions Download",
            'slug'          => "dailysessions.download",
            'description'   => "Download Daily Sessions"
        ]);

        Permission::firstOrCreate([
            'name'          => "Daily Sessions Email",
            'slug'          => "dailysessions.email",
            'description'   => "Receive a copy of Daily Sessions emails"
        ]);

        Permission::firstOrCreate([
            'name'          => "Daily Sessions Admin",
            'slug'          => "dailysessions.admin",
            'description'   => "Daily Sessions Admin"
        ]);

        Permission::firstOrCreate([
            'name'          => 'Trivias',
            'slug'          => 'trivias',
            'description'   => 'Show and Answer Trivias'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Trivias Admin',
            'slug'          => 'trivias.admin',
            'description'   => 'Create, show and Download Trivias'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Reporting',
            'slug'          => 'reporting',
            'description'   => 'Reporting'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Reporting Links',
            'slug'          => 'reporting.links',
            'description'   => 'Reporting Links'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Reporting Links Scorecard',
            'slug'          => 'reporting.links.scorecard',
            'description'   => 'Reporting Links Scorecard'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Reporting Links Dashboard',
            'slug'          => 'reporting.links.dashboard',
            'description'   => 'Reporting Links Dashboard'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Reporting Links Admin',
            'slug'          => 'reporting.links.admin',
            'description'   => 'Reporting Links Admin, List, Create, Edit'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Payroll',
            'slug'          => 'payroll',
            'description'   => 'Payroll'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Payroll Adjustments',
            'slug'          => 'payroll.adjustments',
            'description'   => 'Payroll Adjustments'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Payroll OM',
            'slug'          => 'payroll.om',
            'description'   => 'Payroll OM'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Payroll Supervisor',
            'slug'          => 'payroll.supervisor',
            'description'   => 'Payroll Supervisor'
        ]);

        Permission::firstOrCreate([
            'name'          => 'Payroll Admin',
            'slug'          => 'payroll.admin',
            'description'   => 'Payroll Admin'
        ]);


        Permission::firstOrCreate([
            'name'          => 'Enercare Bo Tracker',
            'slug'          => 'enercare.botracker',
            'description'   => 'Enercare Bo Tracker'
        ]);
        Permission::firstOrCreate([
            'name'          => 'Enercare Bo Tracker Leader',
            'slug'          => 'enercare.botracker.leader',
            'description'   => 'Enercare Bo Tracker Leader'
        ]);
        Permission::firstOrCreate([
            'name'          => "Enercare Bo Tracker Reports",
            'slug'          => "enercare.botracker.reports.general",
            'description'   => "Enercare Bo Tracker Reports",
        ]);



    }
}
