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
    protected $signature = 'payroll:createprenomina {--year=} {--month=} {--q=} {--test=}';

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

        if($year && $month && $q){
            $prenomina = new Prenomina($year,$month,$q);    
        }else{
            $prenomina = new Prenomina();
        }

        $this->info("Creating Prenomina...");
        $this->line("Year:$prenomina->year Month:$prenomina->month Q:$prenomina->q");

        if($test){
            switch ($test) {
                case '1':
                    $prenomina->createPrenomina(false,true,false);
                    break;
                case '2':
                    $prenomina->createPrenomina(true,true,false);
                    break;
            }

            return;
        }
        
        $prenomina->createPrenomina();
    }
}
