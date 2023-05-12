<?php

namespace App\Http\Controllers;

use App\InvAdquisicion;
use App\invConsultaStock;
use Illuminate\Http\Request;
use JeroenNoten\LaravelAdminLte\Components\Form\Select;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class InvConsultaStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inv2 = InvAdquisicion::orderBy('id', 'asc')->where('baja', 0)->where('id_asignacion', NULL)->paginate(5);
        $cantidad_articulos =  InvAdquisicion::select('articulo', DB::raw('COUNT(*) as cant'))->groupBy('articulo')->get();
        return view('inventories/consulta.index', compact(['inv2', 'cantidad_articulos']));
    }
    /**
     *
     */
    public function searchArchivos(Request $request)
    {
        $articulos = InvAdquisicion::all();
        //dd($articulos);
        $searchArchivos = $request->get('searchArchivos');
        //dd($searchArticulos);
        $articulos = InvAdquisicion::firstOrNew()->where('codigo', 'like', '%' . $searchArchivos . '%')->paginate(5);
        return view('inventories/consulta.index', compact('articulos'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invConsultaStock  $invConsultaStock
     * @return \Illuminate\Http\Response
     */
    public function show(invConsultaStock $invConsultaStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invConsultaStock  $invConsultaStock
     * @return \Illuminate\Http\Response
     */
    public function edit(invConsultaStock $invConsultaStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invConsultaStock  $invConsultaStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invConsultaStock $invConsultaStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invConsultaStock  $invConsultaStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(invConsultaStock $invConsultaStock)
    {
        //
    }
}
