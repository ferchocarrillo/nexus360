<?php

use App\EnercareCalltrackerPlan;
use Illuminate\Database\Seeder;

class EnercareCalltrackerPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EnercareCalltrackerPlan::create(['name' => '3 in 1', 'valid_sales'=> 1]);
        EnercareCalltrackerPlan::create(['name' => 'CIP Plus', 'valid_sales'=> 1]);
        EnercareCalltrackerPlan::create(['name' => 'MH', 'valid_sales'=> 1]);
        EnercareCalltrackerPlan::create(['name' => 'HIP Plus', 'valid_sales'=> 1]);
        EnercareCalltrackerPlan::create(['name' => 'MA', 'valid_sales'=> 1]);
        EnercareCalltrackerPlan::create(['name' => 'PDP', 'valid_sales'=> 1]);
        EnercareCalltrackerPlan::create(['name' => 'ELP', 'valid_sales'=> 1]);
        EnercareCalltrackerPlan::create(['name' => 'CIP', 'valid_sales'=> 1]);
        EnercareCalltrackerPlan::create(['name' => 'HIP', 'valid_sales'=> 1]);
        EnercareCalltrackerPlan::create(['name' => 'MF', 'valid_sales'=> 1]);
        EnercareCalltrackerPlan::create(['name' => 'Duct Cleaning', 'valid_sales'=> 0]);
        EnercareCalltrackerPlan::create(['name' => 'HVAC or Opportunity', 'valid_sales'=> 0]);
    }
}
