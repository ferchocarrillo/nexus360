<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SalesShowController extends Controller
{


    function __construct()
    {
        $this->middleware('can:enercare.salesranking')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = DB::table("view_enercare_calltracker_rank_sales")->get();
        //SALES agente SERVICE
        //daily
        //$d_aService = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Agent' and Definition LIKE 'Daily-#Sales' and LOB LIKE 'Service' ORDER BY Sales DESC;"));
        $d_aService = $sales->where('Rol', 'Agent')->where('Definition', 'Daily-#Sales')->where('LOB', 'service')->values()->toArray();

        if (!empty($d_aService[0])) {
            $d_aService1        = $d_aService[0]->username;
            $d_aService1Count   = $d_aService[0]->Sales;
        } else {
            $d_aService1        = "";
            $d_aService1Count   = "";
        }

        if (!empty($d_aService[1])) {
            $d_aService2        = $d_aService[1]->username;
            $d_aService2Count   = $d_aService[1]->Sales;
        } else {
            $d_aService2        = "";
            $d_aService2Count   = "";
        }
        if (!empty($d_aService[2])) {
            $d_aService3        = $d_aService[2]->username;
            $d_aService3Count   = $d_aService[2]->Sales;
        } else {
            $d_aService3        = "";
            $d_aService3Count   = "";
        }
        if (!empty($d_aService[3])) {
            $d_aService4        = $d_aService[3]->username;
            $d_aService4Count   = $d_aService[3]->Sales;
        } else {
            $d_aService4        = "";
            $d_aService4Count   = "";
        }
        if (!empty($d_aService[4])) {
            $d_aService5        = $d_aService[4]->username;
            $d_aService5Count   = $d_aService[4]->Sales;
        } else {
            $d_aService5        = "";
            $d_aService5Count   = "";
        }
        if (!empty($d_aService[5])) {
            $d_aService6        = $d_aService[5]->username;
            $d_aService6Count   = $d_aService[5]->Sales;
        } else {
            $d_aService6        = "";
            $d_aService6Count   = "";
        }
        if (!empty($d_aService[6])) {
            $d_aService7        = $d_aService[6]->username;
            $d_aService7Count   = $d_aService[6]->Sales;
        } else {
            $d_aService7        = "";
            $d_aService7Count   = "";
        }
        if (!empty($d_aService[7])) {
            $d_aService8        = $d_aService[7]->username;
            $d_aService8Count   = $d_aService[7]->Sales;
        } else {
            $d_aService8        = "";
            $d_aService8Count   = "";
        }
        //weekly
        $w_aService = $sales->where('Rol', 'Agent')->where('Definition','Weekly-#Sales')->where('LOB', 'service')->values()->toArray();
        //$w_aService = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Agent' and Definition LIKE 'Weekly-#Sales' and LOB LIKE 'service' ORDER BY Sales DESC;"));

        if (!empty($w_aService[0])) {
            $w_aService1        = $w_aService[0]->username;
            $w_aService1Count   = $w_aService[0]->Sales;
        } else {
            $w_aService1        = "";
            $w_aService1Count   = "";
        }
        if (!empty($w_aService[1])) {
            $w_aService2        = $w_aService[1]->username;
            $w_aService2Count   = $w_aService[1]->Sales;
        } else {
            $w_aService2        = "";
            $w_aService2Count   = "";
        }
        if (!empty($w_aService[2])) {
            $w_aService3        = $w_aService[2]->username;
            $w_aService3Count   = $w_aService[2]->Sales;
        } else {
            $w_aService3        = "";
            $w_aService3Count   = "";
        }
        if (!empty($w_aService[3])) {
            $w_aService4        = $w_aService[3]->username;
            $w_aService4Count   = $w_aService[3]->Sales;
        } else {
            $w_aService4        = "";
            $w_aService4Count   = "";
        }
        if (!empty($w_aService[4])) {
            $w_aService5        = $w_aService[4]->username;
            $w_aService5Count   = $w_aService[4]->Sales;
        } else {
            $w_aService5        = "";
            $w_aService5Count   = "";
        }
        if (!empty($w_aService[5])) {
            $w_aService6        = $w_aService[5]->username;
            $w_aService6Count   = $w_aService[5]->Sales;
        } else {
            $w_aService6        = "";
            $w_aService6Count   = "";
        }
        if (!empty($w_aService[6])) {
            $w_aService7        = $w_aService[6]->username;
            $w_aService7Count   = $w_aService[6]->Sales;
        } else {
            $w_aService7        = "";
            $w_aService7Count   = "";
        }
        if (!empty($w_aService[7])) {
            $w_aService8        = $w_aService[7]->username;
            $w_aService8Count   = $w_aService[7]->Sales;
        } else {
            $w_aService8        = "";
            $w_aService8Count   = "";
        }

        //SALES supervisor SERVICE
        //daily
        $d_sService  = $sales->where('Rol', 'Supervisor')->where('Definition','Daily-#Sales')->where('LOB', 'service')->values()->toArray();

        //$d_sService = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Supervisor' and Definition LIKE 'Daily-#Sales' and LOB LIKE 'Service' ORDER BY Sales DESC;"));
        if (!empty($d_sService[0])) {
            $d_sService1        = $d_sService[0]->username;
            $d_sService1Count   = $d_sService[0]->Sales;
        } else {
            $d_sService1        = "";
            $d_sService1Count   = "";
        }
        if (!empty($d_sService[1])) {
            $d_sService2        = $d_sService[1]->username;
            $d_sService2Count   = $d_sService[1]->Sales;
        } else {
            $d_sService2        = "";
            $d_sService2Count   = "";
        }
        if (!empty($d_sService[2])) {
            $d_sService3        = $d_sService[2]->username;
            $d_sService3Count   = $d_sService[2]->Sales;
        } else {
            $d_sService3        = "";
            $d_sService3Count   = "";
        }
        //weekly
        //$w_sService = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Supervisor' and Definition LIKE 'Weekly-#Sales' and LOB LIKE 'Service' ORDER BY Sales DESC;"));
        $w_sService = $sales->where('Rol','Supervisor')->where('Definition','Weekly-#Sales')->where('LOB','service')->values()->toArray();

        if (!empty($w_sService[0])) {
            $w_sService1        = $w_sService[0]->username;
            $w_sService1Count   = $w_sService[0]->Sales;
        } else {
            $w_sService1        = "";
            $w_sService1Count   = "";
        }
        if (!empty($w_sService[1])) {
            $w_sService2        = $w_sService[1]->username;
            $w_sService2Count   = $w_sService[1]->Sales;
        } else {
            $w_sService2        = "";
            $w_sService2Count   = "";
        }
        if (!empty($w_sService[2])) {
            $w_sService3        = $w_sService[2]->username;
            $w_sService3Count   = $w_sService[2]->Sales;
        } else {
            $w_sService3        = "";
            $w_sService3Count   = "";
        }
        //SALES agente BILLING
        //daily
        //$d_aBill = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Agent' and Definition LIKE 'Daily-#Sales' and LOB LIKE 'billing' ORDER BY Sales DESC;"));
        $d_aBill  = $sales->where('Rol', 'Agent')->where('Definition','Daily-#Sales')->where('LOB', 'billing')->values()->toArray();

        if (!empty($d_aBill[0])) {
            $d_aBill1        = $d_aBill[0]->username;
            $d_aBill1Count   = $d_aBill[0]->Sales;
        } else {
            $d_aBill1        = "";
            $d_aBill1Count   = "";
        }
        if (!empty($d_aBill[1])) {
            $d_aBill2        = $d_aBill[1]->username;
            $d_aBill2Count   = $d_aBill[1]->Sales;
        } else {
            $d_aBill2        = "";
            $d_aBill2Count   = "";
        }
        if (!empty($d_aBill[2])) {
            $d_aBill3        = $d_aBill[2]->username;
            $d_aBill3Count   = $d_aBill[2]->Sales;
        } else {
            $d_aBill3        = "";
            $d_aBill3Count   = "";
        }
        if (!empty($d_aBill[3])) {
            $d_aBill4        = $d_aBill[3]->username;
            $d_aBill4Count   = $d_aBill[3]->Sales;
        } else {
            $d_aBill4        = "";
            $d_aBill4Count   = "";
        }
        if (!empty($d_aBill[4])) {
            $d_aBill5        = $d_aBill[4]->username;
            $d_aBill5Count   = $d_aBill[4]->Sales;
        } else {
            $d_aBill5        = "";
            $d_aBill5Count   = "";
        }
        if (!empty($d_aBill[5])) {
            $d_aBill6        = $d_aBill[5]->username;
            $d_aBill6Count   = $d_aBill[5]->Sales;
        } else {
            $d_aBill6        = "";
            $d_aBill6Count   = "";
        }
        if (!empty($d_aBill[6])) {
            $d_aBill7        = $d_aBill[6]->username;
            $d_aBill7Count   = $d_aBill[6]->Sales;
        } else {
            $d_aBill7        = "";
            $d_aBill7Count   = "";
        }
        if (!empty($d_aBill[7])) {
            $d_aBill8        = $d_aBill[7]->username;
            $d_aBill8Count   = $d_aBill[7]->Sales;
        } else {
            $d_aBill8        = "";
            $d_aBill8Count   = "";
        }
        //weekly
        //$w_aBill = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Agent' and Definition LIKE 'Weekly-#Sales' and LOB LIKE 'billing' ORDER BY Sales DESC;"));
        $w_aBill  = $sales->where('Rol', 'Agent')->where('Definition','Weekly-#Sales')->where('LOB', 'billing')->values()->toArray();
        if (!empty($w_aBill[0])) {
            $w_aBill1        = $w_aBill[0]->username;
            $w_aBill1Count   = $w_aBill[0]->Sales;
        } else {
            $w_aBill1        = "";
            $w_aBill1Count   = "";
        }
        if (!empty($w_aBill[1])) {
            $w_aBill2        = $w_aBill[1]->username;
            $w_aBill2Count   = $w_aBill[1]->Sales;
        } else {
            $w_aBill2        = "";
            $w_aBill2Count   = "";
        }
        if (!empty($w_aBill[2])) {
            $w_aBill3        = $w_aBill[2]->username;
            $w_aBill3Count   = $w_aBill[2]->Sales;
        } else {
            $w_aBill3        = "";
            $w_aBill3Count   = "";
        }
        if (!empty($w_aBill[3])) {
            $w_aBill4        = $w_aBill[3]->username;
            $w_aBill4Count   = $w_aBill[3]->Sales;
        } else {
            $w_aBill4        = "";
            $w_aBill4Count   = "";
        }
        if (!empty($w_aBill[4])) {
            $w_aBill5        = $w_aBill[4]->username;
            $w_aBill5Count   = $w_aBill[4]->Sales;
        } else {
            $w_aBill5        = "";
            $w_aBill5Count   = "";
        }
        if (!empty($w_aBill[5])) {
            $w_aBill6        = $w_aBill[5]->username;
            $w_aBill6Count   = $w_aBill[5]->Sales;
        } else {
            $w_aBill6        = "";
            $w_aBill6Count   = "";
        }
        if (!empty($w_aBill[6])) {
            $w_aBill7        = $w_aBill[6]->username;
            $w_aBill7Count   = $w_aBill[6]->Sales;
        } else {
            $w_aBill7        = "";
            $w_aBill7Count   = "";
        }
        if (!empty($w_aBill[7])) {
            $w_aBill8        = $w_aBill[7]->username;
            $w_aBill8Count   = $w_aBill[7]->Sales;
        } else {
            $w_aBill8        = "";
            $w_aBill8Count   = "";
        }
        //SALES supervisor BILLING
        //daily
        //$d_sBill = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Supervisor' and Definition LIKE 'Daily-#Sales' and LOB LIKE 'billing' ORDER BY Sales DESC;"));
        $d_sBill  = $sales->where('Rol', 'Supervisor')->where('Definition','Daily-#Sales')->where('LOB', 'billing')->values()->toArray();
        if (!empty($d_sBill[0])) {
            $d_sBill1        = $d_sBill[0]->username;
            $d_sBill1Count   = $d_sBill[0]->Sales;
        } else {
            $d_sBill1        = "";
            $d_sBill1Count   = "";
        }
        if (!empty($d_sBill[1])) {
            $d_sBill2        = $d_sBill[1]->username;
            $d_sBill2Count   = $d_sBill[1]->Sales;
        } else {
            $d_sBill2        = "";
            $d_sBill2Count   = "";
        }
        if (!empty($d_sBill[2])) {
            $d_sBill3        = $d_sBill[2]->username;
            $d_sBill3Count   = $d_sBill[2]->Sales;
        } else {
            $d_sBill3        = "";
            $d_sBill3Count   = "";
        }

        //weekly
        //$w_sBill = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Supervisor' and Definition LIKE 'Weekly-#Sales' and LOB LIKE 'billing' ORDER BY Sales DESC;"));
        $w_sBill   = $sales->where('Rol', 'Supervisor')->where('Definition','Weekly-#Sales')->where('LOB', 'billing')->values()->toArray();

        if (!empty($w_sBill[0])) {
            $w_sBill1        = $w_sBill[0]->username;
            $w_sBill1Count   = $w_sBill[0]->Sales;
        } else {
            $w_sBill1        = "";
            $w_sBill1Count   = "";
        }
        if (!empty($w_sBill[0])) {
            $w_sBill2        = $w_sBill[1]->username;
            $w_sBill2Count   = $w_sBill[1]->Sales;
        } else {
            $w_sBill2        = "";
            $w_sBill2Count   = "";
        }
        if (!empty($w_sBill[0])) {
            $w_sBill3        = $w_sBill[2]->username;
            $w_sBill3Count   = $w_sBill[2]->Sales;
        } else {
            $w_sBill3        = "";
            $w_sBill3Count   = "";
        }
        //SALES agente OFFLINE
        //daily
        //$d_aOff = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Definition LIKE 'Daily-#Sales' and Rol LIKE 'Agent' and LOB LIKE 'offline' ORDER BY Sales DESC;"));
        $d_aOff   = $sales->where('Rol', 'Agent')->where('Definition','Daily-#Sales')->where('LOB', 'offline')->values()->toArray();

        if (!empty($d_aOff[0])) {
            $d_aOff1        = $d_aOff[0]->username;
            $d_aOff1Count   = $d_aOff[0]->Sales;
        } else {
            $d_aOff1        = "";
            $d_aOff1Count   = "";
        }
        if (!empty($d_aOff[1])) {
            $d_aOff2        = $d_aOff[1]->username;
            $d_aOff2Count   = $d_aOff[1]->Sales;
        } else {
            $d_aOff2        = "";
            $d_aOff2Count   = "";
        }
        if (!empty($d_aOff[2])) {
            $d_aOff3        = $d_aOff[2]->username;
            $d_aOff3Count   = $d_aOff[2]->Sales;
        } else {
            $d_aOff3        = "";
            $d_aOff3Count   = "";
        }
        if (!empty($d_aOff[3])) {
            $d_aOff4        = $d_aOff[3]->username;
            $d_aOff4Count   = $d_aOff[3]->Sales;
        } else {
            $d_aOff4        = "";
            $d_aOff4Count   = "";
        }
        if (!empty($d_aOff[4])) {
            $d_aOff5        = $d_aOff[4]->username;
            $d_aOff5Count   = $d_aOff[4]->Sales;
        } else {
            $d_aOff5        = "";
            $d_aOff5Count   = "";
        }
        if (!empty($d_aOff[5])) {
            $d_aOff6        = $d_aOff[5]->username;
            $d_aOff6Count   = $d_aOff[5]->Sales;
        } else {
            $d_aOff6        = "";
            $d_aOff6Count   = "";
        }
        if (!empty($d_aOff[6])) {
            $d_aOff7        = $d_aOff[6]->username;
            $d_aOff7Count   = $d_aOff[6]->Sales;
        } else {
            $d_aOff7        = "";
            $d_aOff7Count   = "";
        }
        if (!empty($d_aOff[7])) {
            $d_aOff8        = $d_aOff[7]->username;
            $d_aOff8Count   = $d_aOff[7]->Sales;
        } else {
            $d_aOff8        = "";
            $d_aOff8Count   = "";
        }
        //weekly
        //$w_aOff = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Agent' and Definition LIKE 'Weekly-#Sales' and LOB LIKE 'offline' ORDER BY Sales DESC;"));
        $w_aOff    = $sales->where('Rol', 'Agent')->where('Definition','Weekly-#Sales')->where('LOB', 'offline')->values()->toArray();

        if (!empty($w_aOff[0])) {
            $w_aOff1        = $w_aOff[0]->username;
            $w_aOff1Count   = $w_aOff[0]->Sales;
        } else {
            $w_aOff1        = "";
            $w_aOff1Count   = "";
        }
        if (!empty($w_aOff[1])) {
            $w_aOff2        = $w_aOff[1]->username;
            $w_aOff2Count   = $w_aOff[1]->Sales;
        } else {
            $w_aOff2        = "";
            $w_aOff2Count   = "";
        }
        if (!empty($w_aOff[2])) {
            $w_aOff3        = $w_aOff[2]->username;
            $w_aOff3Count   = $w_aOff[2]->Sales;
        } else {
            $w_aOff3        = "";
            $w_aOff3Count   = "";
        }
        if (!empty($w_aOff[3])) {
            $w_aOff4        = $w_aOff[3]->username;
            $w_aOff4Count   = $w_aOff[3]->Sales;
        } else {
            $w_aOff4        = "";
            $w_aOff4Count   = "";
        }
        if (!empty($w_aOff[4])) {
            $w_aOff5        = $w_aOff[4]->username;
            $w_aOff5Count   = $w_aOff[4]->Sales;
        } else {
            $w_aOff5        = "";
            $w_aOff5Count   = "";
        }
        if (!empty($w_aOff[5])) {
            $w_aOff6        = $w_aOff[5]->username;
            $w_aOff6Count   = $w_aOff[5]->Sales;
        } else {
            $w_aOff6        = "";
            $w_aOff6Count   = "";
        }
        if (!empty($w_aOff[6])) {
            $w_aOff7        = $w_aOff[6]->username;
            $w_aOff7Count   = $w_aOff[6]->Sales;
        } else {
            $w_aOff7        = "";
            $w_aOff7Count   = "";
        }
        if (!empty($w_aOff[7])) {
            $w_aOff8        = $w_aOff[7]->username;
            $w_aOff8Count   = $w_aOff[7]->Sales;
        } else {
            $w_aOff8        = "";
            $w_aOff8Count   = "";
        }
        //SALES supervisor OFFLINE
        //daily
        //$d_sOff = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Supervisor' and Definition LIKE 'Daily-#Sales' and LOB LIKE 'offline' ORDER BY Sales DESC;"));
        $d_sOff   = $sales->where('Rol', 'Supervisor')->where('Definition','Daily-#Sales')->where('LOB', 'offline')->values()->toArray();
        if (!empty($d_sOff[0])) {
            $d_sOff1        = $d_sOff[0]->username;
            $d_sOff1Count   = $d_sOff[0]->Sales;
        } else {
            $d_sOff1        = "";
            $d_sOff1Count   = "";
        }
        if (!empty($d_sOff[1])) {
            $d_sOff2        = $d_sOff[1]->username;
            $d_sOff2Count   = $d_sOff[1]->Sales;
        } else {
            $d_sOff2        = "";
            $d_sOff2Count   = "";
        }
        if (!empty($d_sOff[2])) {
            $d_sOff3        = $d_sOff[2]->username;
            $d_sOff3Count   = $d_sOff[2]->Sales;
        } else {
            $d_sOff3        = "";
            $d_sOff3Count   = "";
        }
        //weekly
        //$w_sOff = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Supervisor' and Definition LIKE 'Weekly-#Sales' and LOB LIKE 'offline' ORDER BY Sales DESC;"));
        $w_sOff = $sales->where('Rol', 'Supervisor')->where('Definition','Weekly-#Sales')->where('LOB', 'offline')->values()->toArray();
        if (!empty($w_sOff[0])) {
            $w_sOff1        = $w_sOff[0]->username;
            $w_sOff1Count   = $w_sOff[0]->Sales;
        } else {
            $w_sOff1        = "";
            $w_sOff1Count   = "";
        }
        if (!empty($w_sOff[1])) {
            $w_sOff2        = $w_sOff[1]->username;
            $w_sOff2Count   = $w_sOff[1]->Sales;
        } else {
            $w_sOff2        = "";
            $w_sOff2Count   = "";
        }
        if (!empty($w_sOff[2])) {
            $w_sOff3        = $w_sOff[2]->username;
            $w_sOff3Count   = $w_sOff[2]->Sales;
        } else {
            $w_sOff3        = "";
            $w_sOff3Count   = "";
        }
        //SALES agente OBA
        //daily
        //$d_aOba = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Agent' and Definition LIKE 'Daily-#Sales' and LOB LIKE 'oba' ORDER BY Sales DESC;"));
        $d_aOba = $sales->where('Rol', 'Agent')->where('Definition','Daily-#Sales')->where('LOB', 'oba')->values()->toArray();
        if (!empty($d_aOba)) {
            $d_aOba1        = $d_aOba[0]->username;
            $d_aOba1Count   = $d_aOba[0]->Sales;
        } else {
            $d_aOba1        = "";
            $d_aOba1Count   = "";
        }
        if (!empty($d_aOba[1])) {
            $d_aOba2        = $d_aOba[1]->username;
            $d_aOba2Count   = $d_aOba[1]->Sales;
        } else {
            $d_aOba2        = "";
            $d_aOba2Count   = "";
        }
        if (!empty($d_aOba[2])) {
            $d_aOba3        = $d_aOba[2]->username;
            $d_aOba3Count   = $d_aOba[2]->Sales;
        } else {
            $d_aOba3        = "";
            $d_aOba3Count   = "";
        }
        if (!empty($d_aOba[3])) {
            $d_aOba4        = $d_aOba[3]->username;
            $d_aOba4Count   = $d_aOba[3]->Sales;
        } else {
            $d_aOba4        = "";
            $d_aOba4Count   = "";
        }
        if (!empty($d_aOba[4])) {
            $d_aOba5        = $d_aOba[4]->username;
            $d_aOba5Count   = $d_aOba[4]->Sales;
        } else {
            $d_aOba5        = "";
            $d_aOba5Count   = "";
        }
        if (!empty($d_aOba[5])) {
            $d_aOba6        = $d_aOba[5]->username;
            $d_aOba6Count   = $d_aOba[5]->Sales;
        } else {
            $d_aOba6        = "";
            $d_aOba6Count   = "";
        }
        if (!empty($d_aOba[6])) {
            $d_aOba7        = $d_aOba[6]->username;
            $d_aOba7Count   = $d_aOba[6]->Sales;
        } else {
            $d_aOba7        = "";
            $d_aOba7Count   = "";
        }
        if (!empty($d_aOba[7])) {
            $d_aOba8        = $d_aOba[7]->username;
            $d_aOba8Count   = $d_aOba[7]->Sales;
        } else {
            $d_aOba8        = "";
            $d_aOba8Count   = "";
        }
        //weekly
        //$w_aOba = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Agent' and Definition LIKE 'Weekly-#Sales' and LOB LIKE 'oba' ORDER BY Sales DESC;"));
        $w_aOba = $sales->where('Rol', 'Agent')->where('Definition','Weekly-#Sales')->where('LOB', 'oba')->values()->toArray();
        if (!empty($w_aOba[0])) {
            $w_aOba1        = $w_aOba[0]->username;
            $w_aOba1Count   = $w_aOba[0]->Sales;
        } else {
            $d_aOba1        = "";
            $d_aOba1Count   = "";
        }
        if (!empty($w_aOba[1])) {
            $w_aOba2        = $w_aOba[1]->username;
            $w_aOba2Count   = $w_aOba[1]->Sales;
        } else {
            $w_aOba2        = "";
            $w_aOba2Count   = "";
        }
        if (!empty($w_aOba[2])) {
            $w_aOba3        = $w_aOba[2]->username;
            $w_aOba3Count   = $w_aOba[2]->Sales;
        } else {
            $w_aOba3        = "";
            $w_aOba3Count   = "";
        }
        if (!empty($w_aOba[3])) {
            $w_aOba4        = $w_aOba[3]->username;
            $w_aOba4Count   = $w_aOba[3]->Sales;
        } else {
            $w_aOba4        = "";
            $w_aOba4Count   = "";
        }
        if (!empty($w_aOba[4])) {
            $w_aOba5        = $w_aOba[4]->username;
            $w_aOba5Count   = $w_aOba[4]->Sales;
        } else {
            $w_aOba5        = "";
            $w_aOba5Count   = "";
        }
        if (!empty($w_aOba[5])) {
            $w_aOba6        = $w_aOba[5]->username;
            $w_aOba6Count   = $w_aOba[5]->Sales;
        } else {
            $w_aOba6        = "";
            $w_aOba6Count   = "";
        }
        if (!empty($w_aOba[6])) {
            $w_aOba7        = $w_aOba[6]->username;
            $w_aOba7Count   = $w_aOba[6]->Sales;
        } else {
            $w_aOba7        = "";
            $w_aOba7Count   = "";
        }
        if (!empty($w_aOba[7])) {
            $w_aOba8        = $w_aOba[7]->username;
            $w_aOba8Count   = $w_aOba[7]->Sales;
        } else {
            $w_aOba8        = "";
            $w_aOba8Count   = "";
        }
                //SALES supervisor OBA
        //daily
        //$d_sOba = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Supervisor' and Definition LIKE 'Daily-#Sales' and LOB LIKE 'oba' ORDER BY Sales DESC;"));
        $d_sOba   = $sales->where('Rol', 'Supervisor')->where('Definition','Daily-#Sales')->where('LOB', 'oba')->values()->toArray();


        if (!empty($d_sOba[0])) {
            $d_sOba1        = $d_sOba[0]->username;
            $d_sOba1Count   = $d_sOba[0]->Sales;
        } else {
            $d_sOba1        = "";
            $d_sOba1Count   = "";
        }
        if (!empty($d_sOba[1])) {
            $d_sOba2        = $d_sOba[1]->username;
            $d_sOba2Count   = $d_sOba[1]->Sales;
        } else {
            $d_sOba2        = "";
            $d_sOba2Count   = "";
        }
        if (!empty($d_sOba[2])) {
            $d_sOba3        = $d_sOba[2]->username;
            $d_sOba3Count   = $d_sOba[2]->Sales;
        } else {
            $d_sOba3        = "";
            $d_sOba3Count   = "";
        }
        //weekly
        //$w_sOba = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Supervisor' and Definition LIKE 'Weekly-#Sales' and LOB LIKE 'oba' ORDER BY Sales DESC;"));
        $w_sOba = $sales->where('Rol', 'Supervisor')->where('Definition','Weekly-#Sales')->where('LOB', 'oba')->values()->toArray();
         if (!empty($w_sOba[0])) {
            $w_sOba1        = $w_sOba[0]->username;
            $w_sOba1Count   = $w_sOba[0]->Sales;
        } else {
            $w_sOba1        = "";
            $w_sOba1Count   = "";
        }
        if (!empty($w_sOba[1])) {
            $w_sOba2        = $w_sOba[1]->username;
            $w_sOba2Count   = $w_sOba[1]->Sales;
        } else {
            $w_sOba2        = "";
            $w_sOba2Count   = "";
        }
        if (!empty($w_sOba[3])) {
            $w_sOba3        = $w_sOba[3]->username;
            $w_sOba3Count   = $w_sOba[3]->Sales;
        } else {
            $w_sOba3        = "";
            $w_sOba3Count   = "";
        }
       //SALES agente over nigth
        //daily
        //$d_aOut = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Agent' and Definition LIKE 'Daily-#Sales' and LOB LIKE 'outbound' ORDER BY Sales DESC;"));
        $d_aOut = $sales->where('Rol', 'Agent')->where('Definition','Daily-#Sales')->where('LOB', 'outbound')->values()->toArray();
        if (!empty($d_aOut)) {
            $d_aOut1        = $d_aOut[0]->username;
            $d_aOut1Count   = $d_aOut[0]->Sales;
        } else {
            $d_aOut1        = "";
            $d_aOut1Count   = "";
        }
        if (!empty($d_aOut[1])) {
            $d_aOut2        = $d_aOut[1]->username;
            $d_aOut2Count   = $d_aOut[1]->Sales;
        } else {
            $d_aOut2        = "";
            $d_aOut2Count   = "";
        }
        if (!empty($d_aOut[2])) {
            $d_aOut3        = $d_aOut[2]->username;
            $d_aOut3Count   = $d_aOut[2]->Sales;
        } else {
            $d_aOut3        = "";
            $d_aOut3Count   = "";
        }
        if (!empty($d_aOut[3])) {
            $d_aOut4        = $d_aOut[3]->username;
            $d_aOut4Count   = $d_aOut[3]->Sales;
        } else {
            $d_aOut4        = "";
            $d_aOut4Count   = "";
        }
        if (!empty($d_aOut[4])) {
            $d_aOut5        = $d_aOut[4]->username;
            $d_aOut5Count   = $d_aOut[4]->Sales;
        } else {
            $d_aOut5        = "";
            $d_aOut5Count   = "";
        }
        if (!empty($d_aOut[5])) {
            $d_aOut6        = $d_aOut[5]->username;
            $d_aOut6Count   = $d_aOut[5]->Sales;
        } else {
            $d_aOut6        = "";
            $d_aOut6Count   = "";
        }
        if (!empty($d_aOut[6])) {
            $d_aOut7        = $d_aOut[6]->username;
            $d_aOut7Count   = $d_aOut[6]->Sales;
        } else {
            $d_aOut7        = "";
            $d_aOut7Count   = "";
        }
        if (!empty($d_aOut[7])) {
            $d_aOut8        = $d_aOut[7]->username;
            $d_aOut8Count   = $d_aOut[7]->Sales;
        } else {
            $d_aOut8        = "";
            $d_aOut8Count   = "";
        }
        //weekly
        //$w_aOut = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Agent' and Definition LIKE 'Weekly-#Sales' and LOB LIKE 'outbound' ORDER BY Sales DESC;"));
        $w_aOut = $sales->where('Rol', 'Agent')->where('Definition','Weekly-#Sales')->where('LOB', 'outbound')->values()->toArray();
        if (!empty($w_aOut[0])) {
            $w_aOut1        = $w_aOut[0]->username;
            $w_aOut1Count   = $w_aOut[0]->Sales;
        } else {
            $d_aOut1        = "";
            $d_aOut1Count   = "";
        }
        if (!empty($w_aOut[1])) {
            $w_aOut2        = $w_aOut[1]->username;
            $w_aOut2Count   = $w_aOut[1]->Sales;
        } else {
            $w_aOut2        = "";
            $w_aOut2Count   = "";
        }
        if (!empty($w_aOut[2])) {
            $w_aOut3        = $w_aOut[2]->username;
            $w_aOut3Count   = $w_aOut[2]->Sales;
        } else {
            $w_aOut3        = "";
            $w_aOut3Count   = "";
        }
        if (!empty($w_aOut[3])) {
            $w_aOut4        = $w_aOut[3]->username;
            $w_aOut4Count   = $w_aOut[3]->Sales;
        } else {
            $w_aOut4        = "";
            $w_aOut4Count   = "";
        }
        if (!empty($w_aOut[4])) {
            $w_aOut5        = $w_aOut[4]->username;
            $w_aOut5Count   = $w_aOut[4]->Sales;
        } else {
            $w_aOut5        = "";
            $w_aOut5Count   = "";
        }
        if (!empty($w_aOut[5])) {
            $w_aOut6        = $w_aOut[5]->username;
            $w_aOut6Count   = $w_aOut[5]->Sales;
        } else {
            $w_aOut6        = "";
            $w_aOut6Count   = "";
        }
        if (!empty($w_aOut[6])) {
            $w_aOut7        = $w_aOut[6]->username;
            $w_aOut7Count   = $w_aOut[6]->Sales;
        } else {
            $w_aOut7        = "";
            $w_aOut7Count   = "";
        }
        if (!empty($w_aOut[7])) {
            $w_aOut8        = $w_aOut[7]->username;
            $w_aOut8Count   = $w_aOut[7]->Sales;
        } else {
            $w_aOut8        = "";
            $w_aOut8Count   = "";
        }
                //SALES supervisor OBA
        //daily
        //$d_sOut = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Supervisor' and Definition LIKE 'Daily-#Sales' and LOB LIKE 'outbound' ORDER BY Sales DESC;"));
        $d_sOut   = $sales->where('Rol', 'Supervisor')->where('Definition','Daily-#Sales')->where('LOB', 'outbound')->values()->toArray();

        if (!empty($d_sOut[0])) {
            $d_sOut1        = $d_sOut[0]->username;
            $d_sOut1Count   = $d_sOut[0]->Sales;
        } else {
            $d_sOut1        = "";
            $d_sOut1Count   = "";
        }
        if (!empty($d_sOut[1])) {
            $d_sOut2        = $d_sOut[1]->username;
            $d_sOut2Count   = $d_sOut[1]->Sales;
        } else {
            $d_sOut2        = "";
            $d_sOut2Count   = "";
        }
        if (!empty($d_sOut[2])) {
            $d_sOut3        = $d_sOut[2]->username;
            $d_sOut3Count   = $d_sOut[2]->Sales;
        } else {
            $d_sOut3        = "";
            $d_sOut3Count   = "";
        }
        //weekly
        //$w_sOut = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Supervisor' and Definition LIKE 'Weekly-#Sales' and LOB LIKE 'outbound' ORDER BY Sales DESC;"));
        $w_sOut = $sales->where('Rol', 'Supervisor')->where('Definition','Weekly-#Sales')->where('LOB', 'outbound')->values()->toArray();

        if (!empty($w_sOut[0])) {
            $w_sOut1        = $w_sOut[0]->username;
            $w_sOut1Count   = $w_sOut[0]->Sales;
        } else {
            $w_sOut1        = "";
            $w_sOut1Count   = "";
        }
        if (!empty($w_sOut[1])) {
            $w_sOut2        = $w_sOut[1]->username;
            $w_sOut2Count   = $w_sOut[1]->Sales;
        } else {
            $w_sOut2        = "";
            $w_sOut2Count   = "";
        }
        if (!empty($w_sOut[3])) {
            $w_sOut3        = $w_sOut[3]->username;
            $w_sOut3Count   = $w_sOut[3]->Sales;
        } else {
            $w_sOut3        = "";
            $w_sOut3Count   = "";
        }
        //SALES agente OverNight
        //daily
        //$d_aOver = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Agent' and Definition LIKE 'Daily-#Sales' and LOB LIKE 'overnight' ORDER BY Sales DESC;"));
        $d_aOver = $sales->where('Rol', 'Agent')->where('Definition','Daily-#Sales')->where('LOB', 'overnight')->values()->toArray();
        if (!empty($d_aOver)) {
            $d_aOver1        = $d_aOver[0]->username;
            $d_aOver1Count   = $d_aOver[0]->Sales;
        } else {
            $d_aOver1        = "";
            $d_aOver1Count   = "";
        }
        if (!empty($d_aOver[1])) {
            $d_aOver2        = $d_aOver[1]->username;
            $d_aOver2Count   = $d_aOver[1]->Sales;
        } else {
            $d_aOver2        = "";
            $d_aOver2Count   = "";
        }
        if (!empty($d_aOver[2])) {
            $d_aOver3        = $d_aOver[2]->username;
            $d_aOver3Count   = $d_aOver[2]->Sales;
        } else {
            $d_aOver3        = "";
            $d_aOver3Count   = "";
        }
        if (!empty($d_aOver[3])) {
            $d_aOver4        = $d_aOver[3]->username;
            $d_aOver4Count   = $d_aOver[3]->Sales;
        } else {
            $d_aOver4        = "";
            $d_aOver4Count   = "";
        }
        if (!empty($d_aOver[4])) {
            $d_aOver5        = $d_aOver[4]->username;
            $d_aOver5Count   = $d_aOver[4]->Sales;
        } else {
            $d_aOver5        = "";
            $d_aOver5Count   = "";
        }
        if (!empty($d_aOver[5])) {
            $d_aOver6        = $d_aOver[5]->username;
            $d_aOver6Count   = $d_aOver[5]->Sales;
        } else {
            $d_aOver6        = "";
            $d_aOver6Count   = "";
        }
        if (!empty($d_aOver[6])) {
            $d_aOver7        = $d_aOver[6]->username;
            $d_aOver7Count   = $d_aOver[6]->Sales;
        } else {
            $d_aOver7        = "";
            $d_aOver7Count   = "";
        }
        if (!empty($d_aOver[7])) {
            $d_aOver8        = $d_aOver[7]->username;
            $d_aOver8Count   = $d_aOver[7]->Sales;
        } else {
            $d_aOver8        = "";
            $d_aOver8Count   = "";
        }
        //weekly
        //$w_aOver = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Agent' and Definition LIKE 'Weekly-#Sales' and LOB LIKE 'overnight' ORDER BY Sales DESC;"));
        $w_aOver = $sales->where('Rol', 'Agent')->where('Definition','Weekly-#Sales')->where('LOB', 'overnight')->values()->toArray();

        if (!empty($w_aOver[0])) {
            $w_aOver1        = $w_aOver[0]->username;
            $w_aOver1Count   = $w_aOver[0]->Sales;
        } else {
            $d_aOver1        = "";
            $d_aOver1Count   = "";
        }
        if (!empty($d_aOver[1])) {
            $w_aOver2        = $w_aOver[1]->username;
            $w_aOver2Count   = $w_aOver[1]->Sales;
        } else {
            $w_aOver2        = "";
            $w_aOver2Count   = "";
        }
        if (!empty($w_aOver[2])) {
            $w_aOver3        = $w_aOver[2]->username;
            $w_aOver3Count   = $w_aOver[2]->Sales;
        } else {
            $w_aOver3        = "";
            $w_aOver3Count   = "";
        }
        if (!empty($w_aOver[3])) {
            $w_aOver4        = $w_aOver[3]->username;
            $w_aOver4Count   = $w_aOver[3]->Sales;
        } else {
            $w_aOver4        = "";
            $w_aOver4Count   = "";
        }
        if (!empty($w_aOver[4])) {
            $w_aOver5        = $w_aOver[4]->username;
            $w_aOver5Count   = $w_aOver[4]->Sales;
        } else {
            $w_aOver5        = "";
            $w_aOver5Count   = "";
        }
        if (!empty($w_aOver[5])) {
            $w_aOver6        = $w_aOver[5]->username;
            $w_aOver6Count   = $w_aOver[5]->Sales;
        } else {
            $w_aOver6        = "";
            $w_aOver6Count   = "";
        }
        if (!empty($w_aOver[6])) {
            $w_aOver7        = $w_aOver[6]->username;
            $w_aOver7Count   = $w_aOver[6]->Sales;
        } else {
            $w_aOver7        = "";
            $w_aOver7Count   = "";
        }
        if (!empty($w_aOver[7])) {
            $w_aOver8        = $w_aOver[7]->username;
            $w_aOver8Count   = $w_aOver[7]->Sales;
        } else {
            $w_aOver8        = "";
            $w_aOver8Count   = "";
        }
        //SALES supervisor OBA
        //daily
        //$d_sOver = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Supervisor' and Definition LIKE 'Daily-#Sales' and LOB LIKE 'overnight' ORDER BY Sales DESC;"));
        $d_sOver   = $sales->where('Rol', 'Supervisor')->where('Definition','Daily-#Sales')->where('LOB', 'overnight')->values()->toArray();
        if (!empty($d_sOver[0])) {
            $d_sOver1        = $d_sOver[0]->username;
            $d_sOver1Count   = $d_sOver[0]->Sales;
        } else {
            $d_sOver1        = "";
            $d_sOver1Count   = "";
        }
        if (!empty($d_sOver[1])) {
            $d_sOver2        = $d_sOver[1]->username;
            $d_sOver2Count   = $d_sOver[1]->Sales;
        } else {
            $d_sOver2        = "";
            $d_sOver2Count   = "";
        }
        if (!empty($d_sOver[2])) {
            $d_sOver3        = $d_sOver[2]->username;
            $d_sOver3Count   = $d_sOver[2]->Sales;
        } else {
            $d_sOver3        = "";
            $d_sOver3Count   = "";
        }
        //weekly
        //$w_sOver = (DB::select("select username, Sales from view_enercare_calltracker_rank_sales where Rol LIKE 'Supervisor' and Definition LIKE 'Weekly-#Sales' and LOB LIKE 'overnight' ORDER BY Sales DESC;"));
        $w_sOver = $sales->where('Rol', 'Supervisor')->where('Definition','Weekly-#Sales')->where('LOB', 'overnight')->values()->toArray();

        if (!empty($w_sOver[0])) {
            $w_sOver1        = $w_sOver[0]->username;
            $w_sOver1Count   = $w_sOver[0]->Sales;
        } else {
            $w_sOver1        = "";
            $w_sOver1Count   = "";
        }
        if (!empty($w_sOver[1])) {
            $w_sOver2        = $w_sOver[1]->username;
            $w_sOver2Count   = $w_sOver[1]->Sales;
        } else {
            $w_sOver2        = "";
            $w_sOver2Count   = "";
        }
        if (!empty($w_sOver[3])) {
            $w_sOver3        = $w_sOver[3]->username;
            $w_sOver3Count   = $w_sOver[3]->Sales;
        } else {
            $w_sOver3        = "";
            $w_sOver3Count   = "";
        }

        //sales Convertion
        $salesConvertion = DB::table("view_enercare_calltracker_rank_sales_conversion")->get();
        //$c_a_dService = (DB::select("select Username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Agent' and LOB LIKE 'service' and Definition LIKE 'Daily-%Sales' ORDER BY salesConversion DESC;"));
        $c_a_dService = $salesConvertion->where('Rol', 'Agent')->where('Definition','Daily-%Sales')->where('LOB', 'service')->values()->toArray();
        if (!empty($c_a_dService[0])) {
            $c_a_dService1        = $c_a_dService[0]->Username;
            $c_a_dService1Count   = $format_number1 = number_format($c_a_dService[0]->salesConversion * 100, 2) ;
        } else {
            $c_a_dService1        = "";
            $c_a_dService1Count   = "";
        }
        if (!empty($c_a_dService[1])) {
            $c_a_dService2        = $c_a_dService[1]->Username;
            $c_a_dService2Count   = $format_number2 = number_format($c_a_dService[1]->salesConversion * 100, 2) ;
        } else {
            $c_a_dService2        = "";
            $c_a_dService2Count   = "";
        }
        if (!empty($c_a_dService[2])) {
            $c_a_dService3        = $c_a_dService[2]->Username;
            $c_a_dService3Count   = $format_number3 = number_format($c_a_dService[2]->salesConversion * 100, 2) ;
        } else {
            $c_a_dService3        = "";
            $c_a_dService3Count   = "";
        }
        if (!empty($c_a_dService[3])) {
            $c_a_dService4        = $c_a_dService[3]->Username;
            $c_a_dService4Count   = $format_number4 = number_format($c_a_dService[3]->salesConversion * 100, 2) ;
        } else {
            $c_a_dService4        = "";
            $c_a_dService4Count   = "";
        }
        if (!empty($c_a_dService[4])) {
            $c_a_dService5        = $c_a_dService[4]->Username;
            $c_a_dService5Count   = $format_number5 = number_format($c_a_dService[4]->salesConversion * 100, 2) ;
        } else {
            $c_a_dService5        = "";
            $c_a_dService5Count   = "";
        }
        if (!empty($c_a_dService[5])) {
            $c_a_dService6        = $c_a_dService[5]->Username;
            $c_a_dService6Count   = $format_number6 = number_format($c_a_dService[5]->salesConversion * 100, 2) ;
        } else {
            $c_a_dService6        = "";
            $c_a_dService6Count   = "";
        }
        if (!empty($c_a_dService[6])) {
            $c_a_dService7        = $c_a_dService[6]->Username;
            $c_a_dService7Count   = $format_number7 = number_format($c_a_dService[6]->salesConversion * 100, 2) ;
        } else {
            $c_a_dService7        = "";
            $c_a_dService7Count   = "";
        }
        if (!empty($c_a_dService[7])) {
            $c_a_dService8        = $c_a_dService[7]->Username;
            $c_a_dService8Count   = $format_number8 = number_format($c_a_dService[7]->salesConversion * 100, 2) ;
        } else {
            $c_a_dService8        = "";
            $c_a_dService8Count   = "";
        }

        $c_aService = $salesConvertion->where('Rol', 'Agent')->where('Definition','Weekly-%Sales')->where('LOB', 'service')->values()->toArray();

        //$c_aService = (DB::select("select Username, Definition ,salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Agent' and LOB LIKE 'service' and Definition LIKE 'Weekly-%Sales' ORDER BY salesConversion DESC;"));

        if (!empty($c_aService[0])) {
            $c_aService1        = $c_aService[0]->Username;
            $c_aService1Count   = $format_number1 = number_format($c_aService[0]->salesConversion * 100, 2) ;
        } else {
            $c_aService1        = "";
            $c_aService1Count   = "";
        }
        if (!empty($c_aService[1])) {
            $c_aService2        = $c_aService[1]->Username;
            $c_aService2Count   = $format_number2 = number_format($c_aService[1]->salesConversion * 100, 2);
        } else {
            $c_aService2        = "";
            $c_aService2Count   = "";
        }
        if (!empty($c_aService[2])) {
            $c_aService3        = $c_aService[2]->Username;
            $c_aService3Count   = $format_number3 = number_format($c_aService[2]->salesConversion * 100, 2);
        } else {
            $c_aService3        = "";
            $c_aService3Count   = "";
        }
        if (!empty($c_aService[3])) {
            $c_aService4        = $c_aService[3]->Username;
            $c_aService4Count   = $format_number4 = number_format($c_aService[3]->salesConversion * 100, 2);
        } else {
            $c_aService4        = "";
            $c_aService4Count   = "";
        }
        if (!empty($c_aService[4])) {
            $c_aService5        = $c_aService[4]->Username;
            $c_aService5Count   = $format_number5 = number_format($c_aService[4]->salesConversion * 100, 2);
        } else {
            $c_aService5        = "";
            $c_aService5Count   = "";
        }
        if (!empty($c_aService[5])) {
            $c_aService6        = $c_aService[5]->Username;
            $c_aService6Count   = $format_number6 = number_format($c_aService[5]->salesConversion * 100, 2);
        } else {
            $c_aService6        = "";
            $c_aService6Count   = "";
        }
        if (!empty($c_aService[6])) {
            $c_aService7        = $c_aService[6]->Username;
            $c_aService7Count   = $format_number7 = number_format($c_aService[6]->salesConversion * 100, 2);
        } else {
            $c_aService7        = "";
            $c_aService7Count   = "";
        }
        if (!empty($c_aService[7])) {
            $c_aService8        = $c_aService[7]->Username;
            $c_aService8Count   = $format_number8 = number_format($c_aService[7]->salesConversion * 100, 2);
        } else {
            $c_aService8        = "";
            $c_aService8Count   = "";
        }

        //$c_s_dService = (DB::select("select Username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Supervisor' and Definition LIKE 'Daily-%Sales' and LOB LIKE 'service' ORDER BY salesConversion DESC;"));
        $c_s_dService = $salesConvertion->where('Rol', 'Supervisor')->where('Definition','Daily-%Sales')->where('LOB', 'service')->values()->toArray();

        if (!empty($c_s_dService[0])) {
            $c_s_dService1        = $c_s_dService[0]->Username;
            $c_s_dService1Count   = $format_number1 = number_format($c_s_dService[0]->salesConversion * 100, 2);
        } else {
            $c_s_dService1        = "";
            $c_s_dService1Count   = "";
        }
        if (!empty($c_s_dService[1])) {
            $c_s_dService2        = $c_s_dService[1]->Username;
            $c_s_dService2Count   = $format_number2 = number_format($c_s_dService[1]->salesConversion * 100, 2);
        } else {
            $c_s_dService2        = "";
            $c_s_dService2Count   = "";
        }
        if (!empty($c_s_dService[2])) {
            $c_s_dService3        = $c_s_dService[2]->Username;
            $c_s_dService3Count   = $format_number3 = number_format($c_s_dService[2]->salesConversion * 100, 2);
        } else {
            $c_s_dService3        = "";
            $c_s_dService3Count   = "";
        }

        //$c_sService = (DB::select("select Username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Supervisor' and LOB LIKE 'service' ORDER BY salesConversion DESC;"));
        $c_sService = $salesConvertion->where('Rol', 'Supervisor')->where('Definition','Weekly-%Sales')->where('LOB', 'service')->values()->toArray();

        if (!empty($c_sService[0])) {
            $c_sService1        = $c_sService[0]->Username;
            $c_sService1Count   = $format_number1 = number_format($c_sService[0]->salesConversion * 100, 2);
        } else {
            $c_sService1        = "";
            $c_sService1Count   = "";
        }
        if (!empty($c_sService[1])) {
            $c_sService2        = $c_sService[1]->Username;
            $c_sService2Count   = $format_number2 = number_format($c_sService[1]->salesConversion * 100, 2);
        } else {
            $c_sService2        = "";
            $c_sService2Count   = "";
        }
        if (!empty($c_sService[2])) {
            $c_sService3        = $c_sService[2]->Username;
            $c_sService3Count   = $format_number2 = number_format($c_sService[2]->salesConversion * 100, 2);
        } else {
            $c_sService3        = "";
            $c_sService3Count   = "";
        }


        //$c_aBill = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Agent' and Definition LIKE 'Weekly-%Sales' and LOB LIKE 'billing' ORDER BY salesConversion DESC;"));
        $c_aBill = $salesConvertion->where('Rol', 'Agent')->where('Definition','Weekly-%Sales')->where('LOB', 'billing')->values()->toArray();

        if (!empty($c_aBill[0])) {
            $c_aBill1        = $c_aBill[0]->Username;
            $c_aBill1Count   = $format_number1 = number_format($c_aBill[0]->salesConversion * 100, 2);
        } else {
            $c_aBill1        = "";
            $c_aBill1Count   = "";
        }
        if (!empty($c_aBill[1])) {
            $c_aBill2        = $c_aBill[1]->Username;
            $c_aBill2Count   = $format_number2 = number_format($c_aBill[1]->salesConversion * 100, 2);
        } else {
            $c_aBill2        = "";
            $c_aBill2Count   = "";
        }
        if (!empty($c_aBill[2])) {
            $c_aBill3        = $c_aBill[2]->Username;
            $c_aBill3Count   = $format_number3 = number_format($c_aBill[2]->salesConversion * 100, 2);
        } else {
            $c_aBill3        = "";
            $c_aBill3Count   = "";
        }
        if (!empty($c_aBill[3])) {
            $c_aBill4        = $c_aBill[3]->Username;
            $c_aBill4Count   = $format_number4 = number_format($c_aBill[3]->salesConversion * 100, 2);
        } else {
            $c_aBill4        = "";
            $c_aBill4Count   = "";
        }
        if (!empty($c_aBill[4])) {
            $c_aBill5        = $c_aBill[4]->Username;
            $c_aBill5Count   = $format_number5 = number_format($c_aBill[4]->salesConversion * 100, 2);
        } else {
            $c_aBill5        = "";
            $c_aBill5Count   = "";
        }
        if (!empty($c_aBill[5])) {
            $c_aBill6        = $c_aBill[5]->Username;
            $c_aBill6Count   = $format_number6 = number_format($c_aBill[5]->salesConversion * 100, 2);
        } else {
            $c_aBill6        = "";
            $c_aBill6Count   = "";
        }
        if (!empty($c_aBill[6])) {
            $c_aBill7        = $c_aBill[6]->Username;
            $c_aBill7Count   = $format_number7 = number_format($c_aBill[6]->salesConversion * 100, 2);
        } else {
            $c_aBill7        = "";
            $c_aBill7Count   = "";
        }
        if (!empty($c_aBill[7])) {
            $c_aBill8        = $c_aBill[7]->Username;
            $c_aBill8Count   = $format_number8 = number_format($c_aBill[7]->salesConversion * 100, 2);
        } else {
            $c_aBill8        = "";
            $c_aBill8Count   = "";
        }


        //$c_a_dBill = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Agent' and Definition LIKE 'Daily-%Sales' and LOB LIKE 'billing' ORDER BY salesConversion DESC;"));
        $c_a_dBill = $salesConvertion->where('Rol', 'Agent')->where('Definition','Daily-%Sales')->where('LOB', 'billing')->values()->toArray();

        if (!empty($c_a_dBill[0])) {
            $c_a_dBill1        = $c_a_dBill[0]->Username;
            $c_a_dBill1Count   = $format_number1 = number_format($c_a_dBill[0]->salesConversion * 100, 2);
        } else {
            $c_a_dBill1        = "";
            $c_a_dBill1Count   = "";
        }
        if (!empty($c_a_dBill[1])) {
            $c_a_dBill2        = $c_a_dBill[1]->Username;
            $c_a_dBill2Count   = $format_number2 = number_format($c_a_dBill[1]->salesConversion * 100, 2);
        } else {
            $c_a_dBill2        = "";
            $c_a_dBill2Count   = "";
        }
        if (!empty($c_a_dBill[2])) {
            $c_a_dBill3        = $c_a_dBill[2]->Username;
            $c_a_dBill3Count   = $format_number3 = number_format($c_a_dBill[2]->salesConversion * 100, 2);
        } else {
            $c_a_dBill3        = "";
            $c_a_dBill3Count   = "";
        }
        if (!empty($c_a_dBill[3])) {
            $c_a_dBill4        = $c_a_dBill[3]->Username;
            $c_a_dBill4Count   = $format_number4 = number_format($c_a_dBill[3]->salesConversion * 100, 2);
        } else {
            $c_a_dBill4        = "";
            $c_a_dBill4Count   = "";
        }
        if (!empty($c_a_dBill[4])) {
            $c_a_dBill5        = $c_a_dBill[4]->Username;
            $c_a_dBill5Count   = $format_number5 = number_format($c_a_dBill[4]->salesConversion * 100, 2);
        } else {
            $c_a_dBill5        = "";
            $c_a_dBill5Count   = "";
        }
        if (!empty($c_a_dBill[5])) {
            $c_a_dBill6        = $c_a_dBill[5]->Username;
            $c_a_dBill6Count   = $format_number6 = number_format($c_a_dBill[5]->salesConversion * 100, 2);
        } else {
            $c_a_dBill6        = "";
            $c_a_dBill6Count   = "";
        }
        if (!empty($c_a_dBill[6])) {
            $c_a_dBill7        = $c_a_dBill[6]->Username;
            $c_a_dBill7Count   = $format_number7 = number_format($c_a_dBill[6]->salesConversion * 100, 2);
        } else {
            $c_a_dBill7        = "";
            $c_a_dBill7Count   = "";
        }
        if (!empty($c_a_dBill[7])) {
            $c_a_dBill8        = $c_a_dBill[7]->Username;
            $c_a_dBill8Count   = $format_number8 = number_format($c_a_dBill[7]->salesConversion * 100, 2);
        } else {
            $c_a_dBill8        = "";
            $c_a_dBill8Count   = "";
        }



        //$c_sBill = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Supervisor' and LOB LIKE 'billing' ORDER BY salesConversion DESC;"));
        $c_sBill = $salesConvertion->where('Rol', 'Supervisor')->where('Definition','Weekly-%Sales')->where('LOB', 'billing')->values()->toArray();

        if (!empty($c_sBill[0])) {
            $c_sBill1        = $c_sBill[0]->Username;
            $c_sBill1Count   = $format_number1 = number_format($c_sBill[0]->salesConversion * 100, 2);
        } else {
            $c_sBill1        = "";
            $c_sBill1Count   = "";
        }
        if (!empty($c_sBill[1])) {
            $c_sBill2        = $c_sBill[1]->Username;
            $c_sBill2Count   = $format_number2 = number_format($c_sBill[1]->salesConversion * 100, 2);
        } else {
            $c_sBill2        = "";
            $c_sBill2Count   = "";
        }
        if (!empty($c_sBill[2])) {
            $c_sBill3        = $c_sBill[2]->Username;
            $c_sBill3Count   = $format_number2 = number_format($c_sBill[2]->salesConversion * 100, 2);
        } else {
            $c_sBill3        = "";
            $c_sBill3Count   = "";
        }


        //$c_s_dBill = (DB::select("select Username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Supervisor' and Definition LIKE 'Daily-%Sales' and LOB LIKE 'billing' ORDER BY salesConversion DESC;"));

        $c_s_dBill = $salesConvertion->where('Rol', 'Supervisor')->where('Definition','Daily-%Sales')->where('LOB', 'billing')->values()->toArray();


        if (!empty($c_s_dBill[0])) {
            $c_s_dBill1        = $c_s_dBill[0]->Username;
            $c_s_dBill1Count   = $format_number1 = number_format($c_s_dBill[0]->salesConversion * 100, 2);
        } else {
            $c_s_dBill1        = "";
            $c_s_dBill1Count   = "";
        }
        if (!empty($c_s_dBill[1])) {
            $c_s_dBill2        = $c_s_dBill[1]->Username;
            $c_s_dBill2Count   = $format_number2 = number_format($c_s_dBill[1]->salesConversion * 100, 2);
        } else {
            $c_s_dBill2        = "";
            $c_s_dBill2Count   = "";
        }
        if (!empty($c_s_dBill[2])) {
            $c_s_dBill3        = $c_s_dBill[2]->Username;
            $c_s_dBill3Count   = $format_number3 = number_format($c_s_dBill[2]->salesConversion * 100, 2);
        } else {
            $c_s_dBill3        = "";
            $c_s_dBill3Count   = "";
        }



        //$c_a_dOff = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Agent' and Definition LIKE 'Daily-%Sales' and LOB LIKE 'offline' ORDER BY salesConversion DESC;"));

        $c_a_dOff = $salesConvertion->where('Rol', 'Agent')->where('Definition','Daily-%Sales')->where('LOB', 'offline')->values()->toArray();

        if (!empty($c_a_dOff[0])) {
            $c_a_dOff1        = $c_a_dOff[0]->Username;
            $c_a_dOff1Count   = $format_number1 = number_format($c_a_dOff[0]->salesConversion * 100, 2);
        } else {
            $c_a_dOff1        = "";
            $c_a_dOff1Count   = "";
        }
        if (!empty($c_a_dOff[1])) {
            $c_a_dOff2        = $c_a_dOff[1]->Username;
            $c_a_dOff2Count   = $format_number2 = number_format($c_a_dOff[1]->salesConversion * 100, 2);
        } else {
            $c_a_dOff2        = "";
            $c_a_dOff2Count   = "";
        }
        if (!empty($c_a_dOff[2])) {
            $c_a_dOff3        = $c_a_dOff[2]->Username;
            $c_a_dOff3Count   = $format_number3 = number_format($c_a_dOff[2]->salesConversion * 100, 2);
        } else {
            $c_a_dOff3        = "";
            $c_a_dOff3Count   = "";
        }
        if (!empty($c_a_dOff[3])) {
            $c_a_dOff4        = $c_a_dOff[3]->Username;
            $c_a_dOff4Count   = $format_number4 = number_format($c_a_dOff[3]->salesConversion * 100, 2);
        } else {
            $c_a_dOff4        = "";
            $c_a_dOff4Count   = "";
        }
        if (!empty($c_a_dOff[4])) {
            $c_a_dOff5        = $c_a_dOff[4]->Username;
            $c_a_dOff5Count   = $format_number5 = number_format($c_a_dOff[4]->salesConversion * 100, 2);
        } else {
            $c_a_dOff5        = "";
            $c_a_dOff5Count   = "";
        }
        if (!empty($c_a_dOff[5])) {
            $c_a_dOff6        = $c_a_dOff[5]->Username;
            $c_a_dOff6Count   = $format_number6 = number_format($c_a_dOff[5]->salesConversion * 100, 2);
        } else {
            $c_a_dOff6        = "";
            $c_a_dOff6Count   = "";
        }
        if (!empty($c_a_dOff[6])) {
            $c_a_dOff7        = $c_a_dOff[6]->Username;
            $c_a_dOff7Count   = $format_number7 = number_format($c_a_dOff[6]->salesConversion * 100, 2);
        } else {
            $c_a_dOff7        = "";
            $c_a_dOff7Count   = "";
        }
        if (!empty($c_a_dOff[7])) {
            $c_a_dOff8        = $c_a_dOff[7]->Username;
            $c_a_dOff8Count   = $format_number8 = number_format($c_a_dOff[7]->salesConversion * 100, 2);
        } else {
            $c_a_dOff8        = "";
            $c_a_dOff8Count   = "";
        }



        //$c_aOff = (DB::select("select Username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Agent' and LOB LIKE 'offline' ORDER BY salesConversion DESC;"));
        $c_aOff = $salesConvertion->where('Rol', 'Agent')->where('Definition','Weekly-%Sales')->where('LOB', 'offline')->values()->toArray();

        if (!empty($c_aOff[0])) {
            $c_aOff1        = $c_aOff[0]->Username;
            $c_aOff1Count   = $format_number1 = number_format($c_aOff[0]->salesConversion * 100, 2);
        } else {
            $c_aOff1        = "";
            $c_aOff1Count   = "";
        }
        if (!empty($c_aOff[1])) {
            $c_aOff2        = $c_aOff[1]->Username;
            $c_aOff2Count   = $format_number2 = number_format($c_aOff[1]->salesConversion * 100, 2);
        } else {
            $c_aOff2        = "";
            $c_aOff2Count   = "";
        }
        if (!empty($c_aOff[2])) {
            $c_aOff3        = $c_aOff[2]->Username;
            $c_aOff3Count   = $format_number3 = number_format($c_aOff[2]->salesConversion * 100, 2);
        } else {
            $c_aOff3        = "";
            $c_aOff3Count   = "";
        }
        if (!empty($c_aOff[3])) {
            $c_aOff4        = $c_aOff[3]->Username;
            $c_aOff4Count   = $format_number4 = number_format($c_aOff[3]->salesConversion * 100, 2);
        } else {
            $c_aOff4        = "";
            $c_aOff4Count   = "";
        }
        if (!empty($c_aOff[4])) {
            $c_aOff5        = $c_aOff[4]->Username;
            $c_aOff5Count   = $format_number5 = number_format($c_aOff[4]->salesConversion * 100, 2);
        } else {
            $c_aOff5        = "";
            $c_aOff5Count   = "";
        }
        if (!empty($c_aOff[5])) {
            $c_aOff6        = $c_aOff[5]->Username;
            $c_aOff6Count   = $format_number6 = number_format($c_aOff[5]->salesConversion * 100, 2);
        } else {
            $c_aOff6        = "";
            $c_aOff6Count   = "";
        }
        if (!empty($c_aOff[6])) {
            $c_aOff7        = $c_aOff[6]->Username;
            $c_aOff7Count   = $format_number7 = number_format($c_aOff[6]->salesConversion * 100, 2);
        } else {
            $c_aOff7        = "";
            $c_aOff7Count   = "";
        }
        if (!empty($c_aOff[7])) {
            $c_aOff8        = $c_aOff[7]->Username;
            $c_aOff8Count   = $format_number8 = number_format($c_aOff[7]->salesConversion * 100, 2);
        } else {
            $c_aOff8        = "";
            $c_aOff8Count   = "";
        }


        //$c_s_dOff = (DB::select("select Username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Supervisor' and Definition LIKE 'Daily-%Sales' and LOB LIKE 'offline' ORDER BY salesConversion DESC;"));
        $c_s_dOff = $salesConvertion->where('Rol', 'Supervisor')->where('Definition','Daily-%Sales')->where('LOB', 'offline')->values()->toArray();

        if (!empty($c_s_dOff[0])) {
            $c_s_dOff1        = $c_s_dOff[0]->Username;
            $c_s_dOff1Count   = $format_number1 = number_format($c_s_dOff[0]->salesConversion * 100, 2);
        } else {
            $c_s_dOff1        = "";
            $c_s_dOff1Count   = "";
        }
        if (!empty($c_s_dOff[1])) {
            $c_s_dOff2        = $c_s_dOff[1]->Username;
            $c_s_dOff2Count   = $format_number2 = number_format($c_s_dOff[1]->salesConversion * 100, 2);
        } else {
            $c_s_dOff2        = "";
            $c_s_dOff2Count   = "";
        }
        if (!empty($c_s_dOff[2])) {
            $c_s_dOff3        = $c_s_dOff[2]->Username;
            $c_s_dOff3Count   = $format_number2 = number_format($c_s_dOff[2]->salesConversion * 100, 2);
        } else {
            $c_s_dOff3        = "";
            $c_s_dOff3Count   = "";
        }

        //$c_sOff = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Supervisor' and LOB LIKE 'offline' ORDER BY salesConversion DESC;"));
        $c_sOff = $salesConvertion->where('Rol', 'Supervisor')->where('Definition','Weekly-%Sales')->where('LOB', 'offline')->values()->toArray();

        if (!empty($c_sOff[0])) {
            $c_sOff1        = $c_sOff[0]->Username;
            $c_sOff1Count   = $format_number1 = number_format($c_sOff[0]->salesConversion * 100, 2);
        } else {
            $c_sOff1        = "";
            $c_sOff1Count   = "";
        }
        if (!empty($c_sOff[1])) {
            $c_sOff2        = $c_sOff[1]->Username;
            $c_sOff2Count   = $format_number2 = number_format($c_sOff[1]->salesConversion * 100, 2);
        } else {
            $c_sOff2        = "";
            $c_sOff2Count   = "";
        }
        if (!empty($c_sOff[2])) {
            $c_sOff3        = $c_sOff[2]->Username;
            $c_sOff3Count   = $format_number2 = number_format($c_sOff[2]->salesConversion * 100, 2);
        } else {
            $c_sOff3        = "";
            $c_sOff3Count   = "";
        }

        //$c_a_dOba = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Agent' and Definition LIKE 'Daily-%Sales' and LOB LIKE 'oba' ORDER BY salesConversion DESC;"));
        $c_a_dOba = $salesConvertion->where('Rol', 'Agent')->where('Definition','Daily-%Sales')->where('LOB', 'oba')->values()->toArray();
        if (!empty($c_a_dOba[0])) {
            $c_a_dOba1        = $c_a_dOba[0]->Username;
            $c_a_dOba1Count   = $format_number1 = number_format($c_a_dOba[0]->salesConversion * 100, 2);
        } else {
            $c_a_dOba1        = "";
            $c_a_dOba1Count   = "";
        }
        if (!empty($c_a_dOba[1])) {
            $c_a_dOba2        = $c_a_dOba[1]->Username;
            $c_a_dOba2Count   = $format_number2 = number_format($c_a_dOba[1]->salesConversion * 100, 2);
        } else {
            $c_a_dOba2        = "";
            $c_a_dOba2Count   = "";
        }
        if (!empty($c_a_dOba[2])) {
            $c_a_dOba3        = $c_a_dOba[2]->Username;
            $c_a_dOba3Count   = $format_number3 = number_format($c_a_dOba[2]->salesConversion * 100, 2);
        } else {
            $c_a_dOba3        = "";
            $c_a_dOba3Count   = "";
        }
        if (!empty($c_a_dOba[3])) {
            $c_a_dOba4        = $c_a_dOba[3]->Username;
            $c_a_dOba4Count   = $format_number4 = number_format($c_a_dOba[3]->salesConversion * 100, 2);
        } else {
            $c_a_dOba4        = "";
            $c_a_dOba4Count   = "";
        }
        if (!empty($c_a_dOba[4])) {
            $c_a_dOba5        = $c_a_dOba[4]->Username;
            $c_a_dOba5Count   = $format_number5 = number_format($c_a_dOba[4]->salesConversion * 100, 2);
        } else {
            $c_a_dOba5        = "";
            $c_a_dOba5Count   = "";
        }
        if (!empty($c_a_dOba[5])) {
            $c_a_dOba6        = $c_a_dOba[5]->Username;
            $c_a_dOba6Count   = $format_number6 = number_format($c_a_dOba[5]->salesConversion * 100, 2);
        } else {
            $c_a_dOba6        = "";
            $c_a_dOba6Count   = "";
        }
        if (!empty($c_a_dOba[6])) {
            $c_a_dOba7        = $c_a_dOba[6]->Username;
            $c_a_dOba7Count   = $format_number7 = number_format($c_a_dOba[6]->salesConversion * 100, 2);
        } else {
            $c_a_dOba7        = "";
            $c_a_dOba7Count   = "";
        }
        if (!empty($c_a_dOba[7])) {
            $c_a_dOba8        = $c_a_dOba[7]->Username;
            $c_a_dOba8Count   = $format_number8 = number_format($c_a_dOba[7]->salesConversion * 100, 2);
        } else {
            $c_a_dOba8        = "";
            $c_a_dOba8Count   = "";
        }


        //$c_aOba = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Agent' and Definition LIKE 'Weekly-%Sales' and LOB LIKE 'oba' ORDER BY salesConversion DESC;"));
        $c_aOba = $salesConvertion->where('Rol', 'Agent')->where('Definition','Weekly-%Sales')->where('LOB', 'oba')->values()->toArray();

        if (!empty($c_aOba[0])) {
            $c_aOba1        = $c_aOba[0]->Username;
            $c_aOba1Count   = $format_number1 = number_format($c_aOba[0]->salesConversion * 100, 2);
        } else {
            $c_aOba1        = "";
            $c_aOba1Count   = "";
        }
        if (!empty($c_aOba[1])) {
            $c_aOba2        = $c_aOba[1]->Username;
            $c_aOba2Count   = $format_number2 = number_format($c_aOba[1]->salesConversion * 100, 2);
        } else {
            $c_aOba2        = "";
            $c_aOba2Count   = "";
        }
        if (!empty($c_aOba[2])) {
            $c_aOba3        = $c_aOba[2]->Username;
            $c_aOba3Count   = $format_number3 = number_format($c_aOba[2]->salesConversion * 100, 2);
        } else {
            $c_aOba3        = "";
            $c_aOba3Count   = "";
        }
        if (!empty($c_aOba[3])) {
            $c_aOba4        = $c_aOba[3]->Username;
            $c_aOba4Count   = $format_number4 = number_format($c_aOba[3]->salesConversion * 100, 2);
        } else {
            $c_aOba4        = "";
            $c_aOba4Count   = "";
        }
        if (!empty($c_aOba[4])) {
            $c_aOba5        = $c_aOba[4]->Username;
            $c_aOba5Count   = $format_number5 = number_format($c_aOba[4]->salesConversion * 100, 2);
        } else {
            $c_aOba5        = "";
            $c_aOba5Count   = "";
        }
        if (!empty($c_aOba[5])) {
            $c_aOba6        = $c_aOba[5]->Username;
            $c_aOba6Count   = $format_number6 = number_format($c_aOba[5]->salesConversion * 100, 2);
        } else {
            $c_aOba6        = "";
            $c_aOba6Count   = "";
        }
        if (!empty($c_aOba[6])) {
            $c_aOba7        = $c_aOba[6]->Username;
            $c_aOba7Count   = $format_number7 = number_format($c_aOba[6]->salesConversion * 100, 2);
        } else {
            $c_aOba7        = "";
            $c_aOba7Count   = "";
        }
        if (!empty($c_aOba[7])) {
            $c_aOba8        = $c_aOba[7]->Username;
            $c_aOba8Count   = $format_number8 = number_format($c_aOba[7]->salesConversion * 100, 2);
        } else {
            $c_aOba8        = "";
            $c_aOba8Count   = "";
        }



        //$c_s_dOba = (DB::select("select Username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Supervisor' and Definition LIKE 'Daily-%Sales' and LOB LIKE 'oba' ORDER BY salesConversion DESC;"));
        $c_s_dOba = $salesConvertion->where('Rol', 'Supervisor')->where('Definition','Weekly-%Sales')->where('LOB', 'offline')->values()->toArray();

        if (!empty($c_s_dOba[0])) {
            $c_s_dOba1        = $c_s_dOba[0]->Username;
            $c_s_dOba1Count   = $format_number1 = number_format($c_s_dOba[0]->salesConversion * 100, 2);
        } else {
            $c_s_dOba1        = "";
            $c_s_dOba1Count   = "";
        }
        if (!empty($c_s_dOba[1])) {
            $c_s_dOba2        = $c_s_dOba[1]->Username;
            $c_s_dOba2Count   = $format_number2 = number_format($c_s_dOba[1]->salesConversion * 100, 2);
        } else {
            $c_s_dOba2        = "";
            $c_s_dOba2Count   = "";
        }
        if (!empty($c_s_dOba[2])) {
            $c_s_dOba3        = $c_s_dOba[2]->Username;
            $c_s_dOba3Count   = $format_number2 = number_format($c_s_dOba[2]->salesConversion * 100, 2);
        } else {
            $c_s_dOba3        = "";
            $c_s_dOba3Count   = "";
        }


        //$c_sOba = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Supervisor' and LOB LIKE 'oba' ORDER BY salesConversion DESC;"));
        $c_sOba = $salesConvertion->where('Rol', 'Supervisor')->where('Definition','Weekly-%Sales')->where('LOB', 'oba')->values()->toArray();

        if (!empty($c_sOba[0])) {
            $c_sOba1        = $c_sOba[0]->Username;
            $c_sOba1Count   = $format_number1 = number_format($c_sOba[0]->salesConversion * 100, 2);
        } else {
            $c_sOba1        = "";
            $c_sOba1Count   = "";
        }
        if (!empty($c_sOba[1])) {
            $c_sOba2        = $c_sOba[1]->Username;
            $c_sOba2Count   = $format_number2 = number_format($c_sOba[1]->salesConversion * 100, 2);
        } else {
            $c_sOba2        = "";
            $c_sOba2Count   = "";
        }
        if (!empty($c_sOba[2])) {
            $c_sOba3        = $c_sOba[2]->Username;
            $c_sOba3Count   = $format_number2 = number_format($c_sOba[2]->salesConversion * 100, 2);
        } else {
            $c_sOba3        = "";
            $c_sOba3Count   = "";
        }


        //$c_a_dOut = (DB::select("select Username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Agent' and Definition LIKE 'Daily-%Sales' and LOB LIKE 'outbound' ORDER BY salesConversion DESC;"));
        $c_a_dOut = $salesConvertion->where('Rol', 'Agent')->where('Definition','Daily-%Sales')->where('LOB', 'outbound')->values()->toArray();

        if (!empty($c_a_dOut[0])) {
            $c_a_dOut1        = $c_a_dOut[0]->Username;
            $c_a_dOut1Count   = $format_number1 = number_format($c_a_dOut[0]->salesConversion * 100, 2);
        } else {
            $c_a_dOut1        = "";
            $c_a_dOut1Count   = "";
        }
        if (!empty($c_a_dOut[1])) {
            $c_a_dOut2        = $c_a_dOut[1]->Username;
            $c_a_dOut2Count   = $format_number2 = number_format($c_a_dOut[1]->salesConversion * 100, 2);
        } else {
            $c_a_dOut2        = "";
            $c_a_dOut2Count   = "";
        }
        if (!empty($c_a_dOut[2])) {
            $c_a_dOut3        = $c_a_dOut[2]->Username;
            $c_a_dOut3Count   = $format_number3 = number_format($c_a_dOut[2]->salesConversion * 100, 2);
        } else {
            $c_a_dOut3        = "";
            $c_a_dOut3Count   = "";
        }
        if (!empty($c_a_dOut[3])) {
            $c_a_dOut4        = $c_a_dOut[3]->Username;
            $c_a_dOut4Count   = $format_number4 = number_format($c_a_dOut[3]->salesConversion * 100, 2);
        } else {
            $c_a_dOut4        = "";
            $c_a_dOut4Count   = "";
        }
        if (!empty($c_a_dOut[4])) {
            $c_a_dOut5        = $c_a_dOut[4]->Username;
            $c_a_dOut5Count   = $format_number5 = number_format($c_a_dOut[4]->salesConversion * 100, 2);
        } else {
            $c_a_dOut5        = "";
            $c_a_dOut5Count   = "";
        }
        if (!empty($c_a_dOut[5])) {
            $c_a_dOut6        = $c_a_dOut[5]->Username;
            $c_a_dOut6Count   = $format_number6 = number_format($c_a_dOut[5]->salesConversion * 100, 2);
        } else {
            $c_a_dOut6        = "";
            $c_a_dOut6Count   = "";
        }
        if (!empty($c_a_dOut[6])) {
            $c_a_dOut7        = $c_a_dOut[6]->Username;
            $c_a_dOut7Count   = $format_number7 = number_format($c_a_dOut[6]->salesConversion * 100, 2);
        } else {
            $c_a_dOut7        = "";
            $c_a_dOut7Count   = "";
        }
        if (!empty($c_a_dOut[7])) {
            $c_a_dOut8        = $c_a_dOut[7]->Username;
            $c_a_dOut8Count   = $format_number8 = number_format($c_a_dOut[7]->salesConversion * 100, 2);
        } else {
            $c_a_dOut8        = "";
            $c_a_dOut8Count   = "";
        }


        //$c_aOut = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Agent' and Definition LIKE 'Weekly-%Sales' and LOB LIKE 'outbound' ORDER BY salesConversion DESC;"));
        $c_aOut = $salesConvertion->where('Rol', 'Agent')->where('Definition','Weekly-%Sales')->where('LOB', 'outbound')->values()->toArray();

        if (!empty($c_aOut[0])) {
            $c_aOut1        = $c_aOut[0]->Username;
            $c_aOut1Count   = $format_number1 = number_format($c_aOut[0]->salesConversion * 100, 2);
        } else {
            $c_aOut1        = "";
            $c_aOut1Count   = "";
        }
        if (!empty($c_aOut[1])) {
            $c_aOut2        = $c_aOut[1]->Username;
            $c_aOut2Count   = $format_number2 = number_format($c_aOut[1]->salesConversion * 100, 2);
        } else {
            $c_aOut2        = "";
            $c_aOut2Count   = "";
        }
        if (!empty($c_aOut[2])) {
            $c_aOut3        = $c_aOut[2]->Username;
            $c_aOut3Count   = $format_number3 = number_format($c_aOut[2]->salesConversion * 100, 2);
        } else {
            $c_aOut3        = "";
            $c_aOut3Count   = "";
        }
        if (!empty($c_aOut[3])) {
            $c_aOut4        = $c_aOut[3]->Username;
            $c_aOut4Count   = $format_number4 = number_format($c_aOut[3]->salesConversion * 100, 2);
        } else {
            $c_aOut4        = "";
            $c_aOut4Count   = "";
        }
        if (!empty($c_aOut[4])) {
            $c_aOut5        = $c_aOut[4]->Username;
            $c_aOut5Count   = $format_number5 = number_format($c_aOut[4]->salesConversion * 100, 2);
        } else {
            $c_aOut5        = "";
            $c_aOut5Count   = "";
        }
        if (!empty($c_aOut[5])) {
            $c_aOut6        = $c_aOut[5]->Username;
            $c_aOut6Count   = $format_number6 = number_format($c_aOut[5]->salesConversion * 100, 2);
        } else {
            $c_aOut6        = "";
            $c_aOut6Count   = "";
        }
        if (!empty($c_aOut[6])) {
            $c_aOut7        = $c_aOut[6]->Username;
            $c_aOut7Count   = $format_number7 = number_format($c_aOut[6]->salesConversion * 100, 2);
        } else {
            $c_aOut7        = "";
            $c_aOut7Count   = "";
        }
        if (!empty($c_aOut[7])) {
            $c_aOut8        = $c_aOut[7]->Username;
            $c_aOut8Count   = $format_number8 = number_format($c_aOut[7]->salesConversion * 100, 2);
        } else {
            $c_aOut8        = "";
            $c_aOut8Count   = "";
        }


        //$c_s_dOut = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Supervisor' and Definition LIKE 'Daily-%Sales' and LOB LIKE 'outbound' ORDER BY salesConversion DESC;"));
        $c_s_dOut= $salesConvertion->where('Rol', 'Supervisor')->where('Definition','Daily-%Sales')->where('LOB', 'outbound')->values()->toArray();

        if (!empty($c_s_dOut[0])) {
            $c_s_dOut1        = $c_s_dOut[0]->Username;
            $c_s_dOut1Count   = $format_number1 = number_format($c_s_dOut[0]->salesConversion * 100, 2);
        } else {
            $c_s_dOut1        = "";
            $c_s_dOut1Count   = "";
        }
        if (!empty($c_s_dOut[1])) {
            $c_s_dOut2        = $c_s_dOut[1]->Username;
            $c_s_dOut2Count   = $format_number2 = number_format($c_s_dOut[1]->salesConversion * 100, 2);
        } else {
            $c_s_dOut2        = "";
            $c_s_dOut2Count   = "";
        }
        if (!empty($c_s_dOut[2])) {
            $c_s_dOut3        = $c_s_dOut[2]->Username;
            $c_s_dOut3Count   = $format_number2 = number_format($c_s_dOut[2]->salesConversion * 100, 2);
        } else {
            $c_s_dOut3        = "";
            $c_s_dOut3Count   = "";
        }

        //$c_sOut = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Supervisor' and Definition LIKE 'Weekly-%Sales' and LOB LIKE 'outbound' ORDER BY salesConversion DESC;"));
        $c_sOut = $salesConvertion->where('Rol', 'Supervisor')->where('Definition','Weekly-%Sales')->where('LOB', 'outbound')->values()->toArray();

        if (!empty($c_sOut[0])) {
            $c_sOut1        = $c_sOut[0]->Username;
            $c_sOut1Count   = $format_number1 = number_format($c_sOut[0]->salesConversion * 100, 2);
        } else {
            $c_sOut1        = "";
            $c_sOut1Count   = "";
        }
        if (!empty($c_sOut[1])) {
            $c_sOut2        = $c_sOut[1]->Username;
            $c_sOut2Count   = $format_number2 = number_format($c_sOut[1]->salesConversion * 100, 2);
        } else {
            $c_sOut2        = "";
            $c_sOut2Count   = "";
        }
        if (!empty($c_sOut[2])) {
            $c_sOut3        = $c_sOut[2]->Username;
            $c_sOut3Count   = $format_number2 = number_format($c_sOut[2]->salesConversion * 100, 2);
        } else {
            $c_sOut3        = "";
            $c_sOut3Count   = "";
        }

        //$c_a_dOver = (DB::select("select Username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Agent' and Definition LIKE 'Daily-%Sales' and LOB LIKE 'overnight' ORDER BY salesConversion DESC;"));
        $c_a_dOver = $salesConvertion->where('Rol', 'Agent')->where('Definition','Daily-%Sales')->where('LOB', 'overnight')->values()->toArray();

        if (!empty($c_a_dOver[0])) {
            $c_a_dOver1        = $c_a_dOver[0]->Username;
            $c_a_dOver1Count   = $format_number1 = number_format($c_a_dOver[0]->salesConversion * 100, 2);
        } else {
            $c_a_dOver1        = "";
            $c_a_dOver1Count   = "";
        }
        if (!empty($c_a_dOver[1])) {
            $c_a_dOver2        = $c_a_dOver[1]->Username;
            $c_a_dOver2Count   = $format_number2 = number_format($c_a_dOver[1]->salesConversion * 100, 2);
        } else {
            $c_a_dOver2        = "";
            $c_a_dOver2Count   = "";
        }
        if (!empty($c_a_dOver[2])) {
            $c_a_dOver3        = $c_a_dOver[2]->Username;
            $c_a_dOver3Count   = $format_number3 = number_format($c_a_dOver[2]->salesConversion * 100, 2);
        } else {
            $c_a_dOver3        = "";
            $c_a_dOver3Count   = "";
        }
        if (!empty($c_a_dOver[3])) {
            $c_a_dOver4        = $c_a_dOver[3]->Username;
            $c_a_dOver4Count   = $format_number4 = number_format($c_a_dOver[3]->salesConversion * 100, 2);
        } else {
            $c_a_dOver4        = "";
            $c_a_dOver4Count   = "";
        }
        if (!empty($c_a_dOver[4])) {
            $c_a_dOver5        = $c_a_dOver[4]->Username;
            $c_a_dOver5Count   = $format_number5 = number_format($c_a_dOver[4]->salesConversion * 100, 2);
        } else {
            $c_a_dOver5        = "";
            $c_a_dOver5Count   = "";
        }
        if (!empty($c_a_dOver[5])) {
            $c_a_dOver6        = $c_a_dOver[5]->Username;
            $c_a_dOver6Count   = $format_number6 = number_format($c_a_dOver[5]->salesConversion * 100, 2);
        } else {
            $c_a_dOver6        = "";
            $c_a_dOver6Count   = "";
        }
        if (!empty($c_a_dOver[6])) {
            $c_a_dOver7        = $c_a_dOver[6]->Username;
            $c_a_dOver7Count   = $format_number7 = number_format($c_a_dOver[6]->salesConversion * 100, 2);
        } else {
            $c_a_dOver7        = "";
            $c_a_dOver7Count   = "";
        }
        if (!empty($c_a_dOver[7])) {
            $c_a_dOver8        = $c_a_dOver[7]->Username;
            $c_a_dOver8Count   = $format_number8 = number_format($c_a_dOver[7]->salesConversion * 100, 2);
        } else {
            $c_a_dOver8        = "";
            $c_a_dOver8Count   = "";
        }


        //$c_aOver = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Agent'and Definition LIKE 'Weekly-%Sales' and LOB LIKE 'overnight' ORDER BY salesConversion DESC;"));
        $c_aOver = $salesConvertion->where('Rol', 'Agent')->where('Definition','Weekly-%Sales')->where('LOB', 'overnight')->values()->toArray();

        if (!empty($c_aOver[0])) {
            $c_aOver1        = $c_aOver[0]->Username;
            $c_aOver1Count   = $format_number1 = number_format($c_aOver[0]->salesConversion * 100, 2);
        } else {
            $c_aOver1        = "";
            $c_aOver1Count   = "";
        }
        if (!empty($c_aOver[1])) {
            $c_aOver2        = $c_aOver[1]->Username;
            $c_aOver2Count   = $format_number2 = number_format($c_aOver[1]->salesConversion * 100, 2);
        } else {
            $c_aOver2        = "";
            $c_aOver2Count   = "";
        }
        if (!empty($c_aOver[2])) {
            $c_aOver3        = $c_aOver[2]->Username;
            $c_aOver3Count   = $format_number3 = number_format($c_aOver[2]->salesConversion * 100, 2);
        } else {
            $c_aOver3        = "";
            $c_aOver3Count   = "";
        }
        if (!empty($c_aOver[3])) {
            $c_aOver4        = $c_aOver[3]->Username;
            $c_aOver4Count   = $format_number4 = number_format($c_aOver[3]->salesConversion * 100, 2);
        } else {
            $c_aOver4        = "";
            $c_aOver4Count   = "";
        }
        if (!empty($c_aOver[4])) {
            $c_aOver5        = $c_aOver[4]->Username;
            $c_aOver5Count   = $format_number5 = number_format($c_aOver[4]->salesConversion * 100, 2);
        } else {
            $c_aOver5        = "";
            $c_aOver5Count   = "";
        }
        if (!empty($c_aOver[5])) {
            $c_aOver6        = $c_aOver[5]->Username;
            $c_aOver6Count   = $format_number6 = number_format($c_aOver[5]->salesConversion * 100, 2);
        } else {
            $c_aOver6        = "";
            $c_aOver6Count   = "";
        }
        if (!empty($c_aOver[6])) {
            $c_aOver7        = $c_aOver[6]->Username;
            $c_aOver7Count   = $format_number7 = number_format($c_aOver[6]->salesConversion * 100, 2);
        } else {
            $c_aOver7        = "";
            $c_aOver7Count   = "";
        }
        if (!empty($c_aOver[7])) {
            $c_aOver8        = $c_aOver[7]->Username;
            $c_aOver8Count   = $format_number8 = number_format($c_aOver[7]->salesConversion * 100, 2);
        } else {
            $c_aOver8        = "";
            $c_aOver8Count   = "";
        }

        //$c_s_dOver = (DB::select("select Username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Supervisor' and Definition LIKE 'Daily-%Sales' and LOB LIKE 'overnight' ORDER BY salesConversion DESC;"));
        $c_s_dOver = $salesConvertion->where('Rol', 'Supervisor')->where('Definition','Daily-%Sales')->where('LOB', 'overnight')->values()->toArray();

        if (!empty($c_s_dOver[0])) {
            $c_s_dOver1        = $c_s_dOver[0]->Username;
            $c_s_dOver1Count   = $format_number1 = number_format($c_s_dOver[0]->salesConversion * 100, 2);
        } else {
            $c_s_dOver1        = "";
            $c_s_dOver1Count   = "";
        }
        if (!empty($c_s_dOver[1])) {
            $c_s_dOver2        = $c_s_dOver[1]->Username;
            $c_s_dOver2Count   = $format_number2 = number_format($c_s_dOver[1]->salesConversion * 100, 2);
        } else {
            $c_s_dOver2        = "";
            $c_s_dOver2Count   = "";
        }
        if (!empty($c_s_dOver[2])) {
            $c_s_dOver3        = $c_s_dOver[2]->Username;
            $c_s_dOver3Count   = $format_number2 = number_format($c_s_dOver[2]->salesConversion * 100, 2);
        } else {
            $c_s_dOver3        = "";
            $c_s_dOver3Count   = "";
        }

        //$c_sOver = (DB::select("select username, salesConversion from view_enercare_calltracker_rank_sales_conversion where Rol LIKE 'Supervisor' and Definition LIKE 'Weekly-%Sales' and LOB LIKE 'overnight' ORDER BY salesConversion DESC;"));
        $c_sOver = $salesConvertion->where('Rol', 'Supervisor')->where('Definition','Weekly-%Sales')->where('LOB', 'overnight')->values()->toArray();

        if (!empty($c_sOver[0])) {
            $c_sOver1        = $c_sOver[0]->Username;
            $c_sOver1Count   = $format_number1 = number_format($c_sOver[0]->salesConversion * 100, 2);
        } else {
            $c_sOver1        = "";
            $c_sOver1Count   = "";
        }
        if (!empty($c_sOver[1])) {
            $c_sOver2        = $c_sOver[1]->Username;
            $c_sOver2Count   = $format_number2 = number_format($c_sOver[1]->salesConversion * 100, 2);
        } else {
            $c_sOver2        = "";
            $c_sOver2Count   = "";
        }
        if (!empty($c_sOver[2])) {
            $c_sOver3        = $c_sOver[2]->Username;
            $c_sOver3Count   = $format_number2 = number_format($c_sOver[2]->salesConversion * 100, 2);
        } else {
            $c_sOver3        = "";
            $c_sOver3Count   = "";
        }


        return view('salesShow.index', compact(
            'salesConvertion',
            'sales',
            'd_aService',
            'd_aService1',
            'd_aService1Count',
            'd_aService2',
            'd_aService2Count',
            'd_aService3',
            'd_aService3Count',
            'd_aService4',
            'd_aService4Count',
            'd_aService5',
            'd_aService5Count',
            'd_aService6',
            'd_aService6Count',
            'd_aService7',
            'd_aService7Count',
            'd_aService8',
            'd_aService8Count',
            'w_aService',
            'w_aService1',
            'w_aService1Count',
            'w_aService2',
            'w_aService2Count',
            'w_aService3',
            'w_aService3Count',
            'w_aService4',
            'w_aService4Count',
            'w_aService5',
            'w_aService5Count',
            'w_aService6',
            'w_aService6Count',
            'w_aService7',
            'w_aService7Count',
            'w_aService8',
            'w_aService8Count',
            'd_sService1',
            'd_sService1Count',
            'd_sService2',
            'd_sService2Count',
            'd_sService3',
            'd_sService3Count',
            'w_sService',
            'w_sService1',
            'w_sService1Count',
            'w_sService2',
            'w_sService2Count',
            'w_sService3',
            'w_sService3Count',
            'd_aBill1',
            'd_aBill1Count',
            'd_aBill2',
            'd_aBill2Count',
            'd_aBill3',
            'd_aBill3Count',
            'd_aBill4',
            'd_aBill4Count',
            'd_aBill5',
            'd_aBill5Count',
            'd_aBill6',
            'd_aBill6Count',
            'd_aBill7',
            'd_aBill7Count',
            'd_aBill8',
            'd_aBill8Count',
            'd_sBill',
            'd_sBill1',
            'd_sBill1Count',
            'd_sBill2',
            'd_sBill2Count',
            'd_sBill3',
            'd_sBill3Count',
            'w_sBill',
            'w_sBill1',
            'w_sBill1Count',
            'w_sBill2',
            'w_sBill2Count',
            'w_sBill3',
            'w_sBill3Count',
            'w_aBill',
            'w_aBill1',
            'w_aBill1Count',
            'w_aBill2',
            'w_aBill2Count',
            'w_aBill3',
            'w_aBill3Count',
            'w_aBill4',
            'w_aBill4Count',
            'w_aBill5',
            'w_aBill5Count',
            'w_aBill6',
            'w_aBill6Count',
            'w_aBill7',
            'w_aBill7Count',
            'w_aBill8',
            'w_aBill8Count',
            'd_aOff1',
            'd_aOff1Count',
            'd_aOff2',
            'd_aOff2Count',
            'd_aOff3',
            'd_aOff3Count',
            'd_aOff4',
            'd_aOff4Count',
            'd_aOff5',
            'd_aOff5Count',
            'd_aOff6',
            'd_aOff6Count',
            'd_aOff7',
            'd_aOff7Count',
            'd_aOff8',
            'd_aOff8Count',
            'w_aOff',
            'd_sOff',
            'd_sOff1',
            'd_sOff1Count',
            'd_sOff2',
            'd_sOff2Count',
            'd_sOff3',
            'd_sOff3Count',
            'w_sOff',
            'w_sOff1',
            'w_sOff1Count',
            'w_sOff2',
            'w_sOff2Count',
            'w_sOff3',
            'w_sOff3Count',
            'w_aOff1',
            'w_aOff1Count',
            'w_aOff2',
            'w_aOff2Count',
            'w_aOff3',
            'w_aOff3Count',
            'w_aOff4',
            'w_aOff4Count',
            'w_aOff5',
            'w_aOff5Count',
            'w_aOff6',
            'w_aOff6Count',
            'w_aOff7',
            'w_aOff7Count',
            'w_aOff8',
            'w_aOff8Count',
            'd_aOba1',
            'd_aOba1Count',
            'd_aOba2',
            'd_aOba2Count',
            'd_aOba3',
            'd_aOba3Count',
            'd_aOba4',
            'd_aOba4Count',
            'd_aOba5',
            'd_aOba5Count',
            'd_aOba6',
            'd_aOba6Count',
            'd_aOba7',
            'd_aOba7Count',
            'd_aOba8',
            'd_aOba8Count',
            'w_aOba',
            'd_sOba',
            'd_sOba1',
            'd_sOba1Count',
            'd_sOba2',
            'd_sOba2Count',
            'd_sOba3',
            'd_sOba3Count',
            'w_sOba',
            'w_sOba1',
            'w_sOba1Count',
            'w_sOba2',
            'w_sOba2Count',
            'w_sOba3',
            'w_sOba3Count',
             'w_aOba1',
             'w_aOba1Count',
            'w_aOba2',
            'w_aOba2Count',
            'w_aOba3',
            'w_aOba3Count',
            'w_aOba4',
            'w_aOba4Count',
            'w_aOba5',
            'w_aOba5Count',
            'w_aOba6',
            'w_aOba6Count',
            'w_aOba7',
            'w_aOba7Count',
            'w_aOba8',
            'w_aOba8Count',
            'd_aOut1',
            'd_aOut1Count',
            'd_aOut2',
            'd_aOut2Count',
            'd_aOut3',
            'd_aOut3Count',
            'd_aOut4',
            'd_aOut4Count',
            'd_aOut5',
            'd_aOut5Count',
            'd_aOut6',
            'd_aOut6Count',
            'd_aOut7',
            'd_aOut7Count',
            'd_aOut8',
            'd_aOut8Count',
            'd_aOut',
            'd_sOut',
            'd_sOut1',
            'd_sOut1Count',
            'd_sOut2',
            'd_sOut2Count',
            'd_sOut3',
            'd_sOut3Count',
            'w_sOut',
            'w_sOut1',
            'w_sOut1Count',
            'w_sOut2',
            'w_sOut2Count',
            'w_sOut3',
            'w_sOut3Count',
            'w_aOut1',
            'w_aOut1Count',
            'w_aOut2',
            'w_aOut2Count',
            'w_aOut3',
            'w_aOut3Count',
            'w_aOut4',
            'w_aOut4Count',
            'w_aOut5',
            'w_aOut5Count',
            'w_aOut6',
            'w_aOut6Count',
            'w_aOut7',
            'w_aOut7Count',
            'w_aOut8',
            'w_aOut8Count',
            'd_aOver1',
            'd_aOver1Count',
            'd_aOver2',
            'd_aOver2Count',
            'd_aOver3',
            'd_aOver3Count',
            'd_aOver4',
            'd_aOver4Count',
            'd_aOver5',
            'd_aOver5Count',
            'd_aOver6',
            'd_aOver6Count',
            'd_aOver7',
            'd_aOver7Count',
            'd_aOver8',
            'd_aOver8Count',
            'd_aOver',
            'd_sOver',
            'd_sOver1',
            'd_sOver1Count',
            'd_sOver2',
            'd_sOver2Count',
            'd_sOver3',
            'd_sOver3Count',
            'w_sOver',
            'w_sOver1',
            'w_sOver1Count',
            'w_sOver2',
            'w_sOver2Count',
            'w_sOver3',
            'w_sOver3Count',
            'w_aOver1',
            'w_aOver1Count',
            'w_aOver2',
            'w_aOver2Count',
            'w_aOver3',
            'w_aOver3Count',
            'w_aOver4',
            'w_aOver4Count',
            'w_aOver5',
            'w_aOver5Count',
            'w_aOver6',
            'w_aOver6Count',
            'w_aOver7',
            'w_aOver7Count',
            'w_aOver8',
            'w_aOver8Count',
            'c_aService',
            'c_aService1',
            'c_aService1Count',
            'c_aService2',
            'c_aService2Count',
            'c_aService3',
            'c_aService3Count',
            'c_aService4',
            'c_aService4Count',
            'c_aService5',
            'c_aService5Count',
            'c_aService6',
            'c_aService6Count',
            'c_aService7',
            'c_aService7Count',
            'c_aService8',
            'c_aService8Count',
            'c_sService',
            'c_sService1',
            'c_sService1Count',
            'c_sService2',
            'c_sService2Count',
            'c_sService3',
            'c_sService3Count',
            'c_aBill',
            'c_aBill1',
            'c_aBill1Count',
            'c_aBill2',
            'c_aBill2Count',
            'c_aBill3',
            'c_aBill3Count',
            'c_aBill4',
            'c_aBill4Count',
            'c_aBill5',
            'c_aBill5Count',
            'c_aBill6',
            'c_aBill6Count',
            'c_aBill7',
            'c_aBill7Count',
            'c_aBill8',
            'c_aBill8Count',
            'c_a_dBill',
            'c_a_dBill1',
            'c_a_dBill1Count',
            'c_a_dBill2',
            'c_a_dBill2Count',
            'c_a_dBill3',
            'c_a_dBill3Count',
            'c_a_dBill4',
            'c_a_dBill4Count',
            'c_a_dBill5',
            'c_a_dBill5Count',
            'c_a_dBill6',
            'c_a_dBill6Count',
            'c_a_dBill7',
            'c_a_dBill7Count',
            'c_a_dBill8',
            'c_a_dBill8Count',
            'c_sBill',
            'c_sBill1',
            'c_sBill1Count',
            'c_sBill2',
            'c_sBill2Count',
            'c_sBill3',
            'c_sBill3Count',

            'c_a_dOff',
            'c_a_dOff1',
            'c_a_dOff1Count',
            'c_a_dOff2',
            'c_a_dOff2Count',
            'c_a_dOff3',
            'c_a_dOff3Count',
            'c_a_dOff4',
            'c_a_dOff4Count',
            'c_a_dOff5',
            'c_a_dOff5Count',
            'c_a_dOff6',
            'c_a_dOff6Count',
            'c_a_dOff7',
            'c_a_dOff7Count',
            'c_a_dOff8',
            'c_a_dOff8Count',

            'c_aOff',
            'c_aOff1',
            'c_aOff1Count',
            'c_aOff2',
            'c_aOff2Count',
            'c_aOff3',
            'c_aOff3Count',
            'c_aOff4',
            'c_aOff4Count',
            'c_aOff5',
            'c_aOff5Count',
            'c_aOff6',
            'c_aOff6Count',
            'c_aOff7',
            'c_aOff7Count',
            'c_aOff8',
            'c_aOff8Count',


            'c_s_dOba',
            'c_s_dOba1',
            'c_s_dOba1Count',
            'c_s_dOba2',
            'c_s_dOba2Count',
            'c_s_dOba3',
            'c_s_dOba3Count',

            'c_s_dOff',
            'c_s_dOff1',
            'c_s_dOff1Count',
            'c_s_dOff2',
            'c_s_dOff2Count',
            'c_s_dOff3',
            'c_s_dOff3Count',

            'c_sOff',
            'c_sOff1',
            'c_sOff1Count',
            'c_sOff2',
            'c_sOff2Count',
            'c_sOff3',
            'c_sOff3Count',

            'c_a_dOba',
            'c_a_dOba1',
            'c_a_dOba1Count',
            'c_a_dOba2',
            'c_a_dOba2Count',
            'c_a_dOba3',
            'c_a_dOba3Count',
            'c_a_dOba4',
            'c_a_dOba4Count',
            'c_a_dOba5',
            'c_a_dOba5Count',
            'c_a_dOba6',
            'c_a_dOba6Count',
            'c_a_dOba7',
            'c_a_dOba7Count',
            'c_a_dOba8',
            'c_a_dOba8Count',

            'c_aOba',
            'c_aOba1',
            'c_aOba1Count',
            'c_aOba2',
            'c_aOba2Count',
            'c_aOba3',
            'c_aOba3Count',
            'c_aOba4',
            'c_aOba4Count',
            'c_aOba5',
            'c_aOba5Count',
            'c_aOba6',
            'c_aOba6Count',
            'c_aOba7',
            'c_aOba7Count',
            'c_aOba8',
            'c_aOba8Count',
            'c_sOba',
            'c_sOba1',
            'c_sOba1Count',
            'c_sOba2',
            'c_sOba2Count',
            'c_sOba3',
            'c_sOba3Count',

            'c_a_dOut',
            'c_a_dOut1',
            'c_a_dOut1Count',
            'c_a_dOut2',
            'c_a_dOut2Count',
            'c_a_dOut3',
            'c_a_dOut3Count',
            'c_a_dOut4',
            'c_a_dOut4Count',
            'c_a_dOut5',
            'c_a_dOut5Count',
            'c_a_dOut6',
            'c_a_dOut6Count',
            'c_a_dOut7',
            'c_a_dOut7Count',
            'c_a_dOut8',
            'c_a_dOut8Count',


            'c_s_dOut',
            'c_s_dOut1',
            'c_s_dOut1Count',
            'c_s_dOut2',
            'c_s_dOut2Count',
            'c_s_dOut3',
            'c_s_dOut3Count',

            'c_aOut',
            'c_aOut1',
            'c_aOut1Count',
            'c_aOut2',
            'c_aOut2Count',
            'c_aOut3',
            'c_aOut3Count',
            'c_aOut4',
            'c_aOut4Count',
            'c_aOut5',
            'c_aOut5Count',
            'c_aOut6',
            'c_aOut6Count',
            'c_aOut7',
            'c_aOut7Count',
            'c_aOut8',
            'c_aOut8Count',
            'c_sOut',
            'c_sOut1',
            'c_sOut1Count',
            'c_sOut2',
            'c_sOut2Count',
            'c_sOut3',
            'c_sOut3Count',

            'c_a_dOver',
            'c_a_dOver1',
            'c_a_dOver1Count',
            'c_a_dOver2',
            'c_a_dOver2Count',
            'c_a_dOver3',
            'c_a_dOver3Count',
            'c_a_dOver4',
            'c_a_dOver4Count',
            'c_a_dOver5',
            'c_a_dOver5Count',
            'c_a_dOver6',
            'c_a_dOver6Count',
            'c_a_dOver7',
            'c_a_dOver7Count',
            'c_a_dOver8',
            'c_a_dOver8Count',

            'c_aOver',
            'c_aOver1',
            'c_aOver1Count',
            'c_aOver2',
            'c_aOver2Count',
            'c_aOver3',
            'c_aOver3Count',
            'c_aOver4',
            'c_aOver4Count',
            'c_aOver5',
            'c_aOver5Count',
            'c_aOver6',
            'c_aOver6Count',
            'c_aOver7',
            'c_aOver7Count',
            'c_aOver8',
            'c_aOver8Count',
            'c_sOver',
            'c_sOver1',
            'c_sOver1Count',
            'c_sOver2',
            'c_sOver2Count',
            'c_sOver3',
            'c_sOver3Count',

            'c_s_dOver',
            'c_s_dOver1',
            'c_s_dOver1Count',
            'c_s_dOver2',
            'c_s_dOver2Count',
            'c_s_dOver3',
            'c_s_dOver3Count',

            'c_a_dService',
            'c_a_dService1',
            'c_a_dService1Count',
            'c_a_dService2',
            'c_a_dService2Count',
            'c_a_dService3',
            'c_a_dService3Count',
            'c_a_dService4',
            'c_a_dService4Count',
            'c_a_dService5',
            'c_a_dService5Count',
            'c_a_dService6',
            'c_a_dService6Count',
            'c_a_dService7',
            'c_a_dService7Count',
            'c_a_dService8',
            'c_a_dService8Count',
            'c_s_dService',
            'c_s_dService1',
            'c_s_dService1Count',
            'c_s_dService2',
            'c_s_dService2Count',
            'c_s_dService3',
            'c_s_dService3Count',
            'c_s_dBill',
            'c_s_dBill1',
            'c_s_dBill1Count',
            'c_s_dBill2',
            'c_s_dBill2Count',
            'c_s_dBill3',
            'c_s_dBill3Count',

        ));
    }
}
