<?php

namespace App\Console\Commands;

use App\Classes\Prenomina;
use Illuminate\Console\Command;

class PayrollCreatePrenominaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payroll:createprenomina 
    {--year= : Year of the fortnight (optional)}
    {--month= : Month of the fortnight (optional)}
    {--q= : Fortnight number (optional)}
    {--test= : (optional); "1" Only Merge Data, "2" Refresh and Merge Data}
    {--nid=* : Filter National Ids}
        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Prenomina';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $year = $this->option('year');
        $month = $this->option('month');
        $q = $this->option('q');
        $test = $this->option('test');
        $filterEmployees = $this->option('nid');

        if($year && $month && $q){
            $prenomina = new Prenomina($year,$month,$q);    
        }else{
            $prenomina = new Prenomina();
        }

        $this->info("Creating Prenomina...");
        $this->line("Year:$prenomina->year Month:$prenomina->month Q:$prenomina->q");

        if($test){
            switch ($test) {
                case '1': // Only Merge Data
                    $prenomina->createPrenomina(false,true,false,$filterEmployees);
                    break;
                case '2': //Refresh and Merge Data
                    $prenomina->createPrenomina(true,true,false,$filterEmployees);
                    break;
            }

            return;
        }
        
        $prenomina->createPrenomina();
    }
}
