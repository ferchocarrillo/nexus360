<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
           PermissionsTableSeeder::class,
           ActivitiesTableSeeder::class,
           UsersTableSeeder::class,
           CgmAppointmentDispositionTableSeeder::class,
           EnercareCalltrackerCategoriesTableSeeder::class,
           EnercareCalltrackerPlansTableSeeder::class,
           EnercareCallTrackerNotPitchAndSalesTableSeeder::class,
           PayrollNoveltyCie10sTableSeeder::class,
           PayrollNoveltyListsTableSeeder::class,
           DailySessionListsTableSeeder::class,
           PayrollAdminsTableSeeder::class,
           KaizenListsTableSeeder::class,
           // EnercareCalltrackerReasonsNotPitchAndSalesTableSeeder::class,
           // EnercareCallTrackerNotPitchSalesTableSeeder::class
           EnercareTrackerSupportFacilitatorSeeder::class,
            DearServiceListSeeder::class,
        ]);
    }
}
