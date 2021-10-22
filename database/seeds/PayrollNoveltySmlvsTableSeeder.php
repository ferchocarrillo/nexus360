<?php

use App\PayrollNoveltySmlv;
use Illuminate\Database\Seeder;


class PayrollNoveltySmlvsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PayrollNoveltySmlv::truncate();

    PayrollNoveltySmlv::create(['year'=>'2017', 'salary'=>737717.00/*, 'daily_salary'=>24590.57*/]);
    PayrollNoveltySmlv::create(['year'=>'2018', 'salary'=>781242.00/*, 'daily_salary'=>26041.40*/]);
    PayrollNoveltySmlv::create(['year'=>'2019', 'salary'=>828116.00/*, 'daily_salary'=>27603.87*/]);
    PayrollNoveltySmlv::create(['year'=>'2020', 'salary'=>877803.00/*, 'daily_salary'=>29260.10*/]);
    PayrollNoveltySmlv::create(['year'=>'2021', 'salary'=>908526.00/*, 'daily_salary'=>30284.20*/]);
    }
}
