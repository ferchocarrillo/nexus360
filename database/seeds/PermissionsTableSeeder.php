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

    }
}
