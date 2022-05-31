<?php

namespace App\Http\Controllers;

use App\ReportingLink;
use Illuminate\Http\Request;

class ReportingLinkController extends Controller
{

    function __construct()
    {
        $this->middleware('can:reporting.links.scorecard')->only(['scorecard']);
        $this->middleware('can:reporting.links.dashboard')->only(['dashboard']);
        $this->middleware('can:reporting.links.admin')->only(['index','create','store','edit','update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = ReportingLink::all();
        return view('reporting.links.index', compact('links'));
    }

    public function create()
    {
        $report =  [
            'Scorecard' => 'Scorecard',
            'Dashboard' => 'Dashboard',
        ];
        $campaign = ReportingLink::select('campaign')->get()->pluck('campaign','campaign');//->push(["id" => "Nueva Campaña", "text" => "Nueva Campaña"]);
        $campaign->prepend("Nueva Campaña", "Nueva Campaña")->toArray();
        return view('reporting/links/create', compact('report', 'campaign'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scorecard()
    {
        $campañas = ReportingLink::select('name', 'url', 'campaign', 'logo')->where('report', 'Scorecard')->get()->groupBy('campaign');
        return view('/reporting.links.scorecard', compact('campañas'));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $campañas = ReportingLink::select('name', 'url', 'campaign', 'logo')->where('report', 'Dashboard')->get()->groupBy('campaign');
        return view('/reporting.links.dashboard', compact('campañas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosReporte = request()->except('_token');
        if ($request->hasFile('logo')) {
            $datosReporte['logo'] = $request->file('logo')->storeAs('reporting_links', $request->campaign . '.png', 'public');
        }
       // dd("reporting_links"."/" . $request->nuevaCampa . ".png");
        $reporte = new ReportingLink();
        $reporte->report    = $request->report;
        if ($request->campaignOld == 'Nueva Campaña') {
            $reporte->campaign   = $request->nuevaCampa;
            $reporte['logo']     = $request->file('logo')->storeAs( 'reporting_links', $request->nuevaCampa. '.png', 'public');
        } else {
            $reporte->campaign   = $request->campaignOld;
            $reporte['logo']     = 'reporting_links/'. $request->campaignOld. '.png';
        }

        $reporte->name       = $request->name;
        $reporte->url        = $request->url;
        $reporte->save();
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReportingLink  $reportingLink
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = ReportingLink::findOrfail($id);
        return view('reporting/links/edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReportingLink  $reportingLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {
        // Busco el id en repo_table
        $report = ReportingLink::findOrFail($id);
        $data = $request->only('url');
        // Valido si el check es igual a 1 lo que significa que se subió un nuevo archivo
        if ($request->check == '1') {
            // Guardo el archivo en la carpeta Publica Uploads y obtengo la ubicacion
            $filepath = $request->file('logo')->storeAs('reporting_links', $report->campaign . '.png', 'public');
            $data['logo'] = $filepath;
        }
        $report->update($data);

        return redirect('reporting/links');



    }

}
