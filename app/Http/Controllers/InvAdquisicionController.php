<?php

namespace App\Http\Controllers;

use App\InvAdquisicion;
use App\InvArticulo;
use Illuminate\Http\Request;
use App\InvProveedores;
use App\InvArticuloAtributo;
use App\InvBodegas;
use App\InvTiporequerimientos;
use App\InvTiposEntradas;
use App\InvUsos;
class InvAdquisicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos_de_entrada = ["Nuevo hallazgo"=>"Nuevo hallazgo","Nueva compra"=>"Nueva compra"];
        $bodega = ["North Point"=>"North Point","Porto 100"=>"Porto 100","Milla de Oro"=>"Milla de Oro"];
        $nit = InvProveedores::select('nit as nit')->pluck('nit');
        $nombreEmpresa = InvProveedores::select('nombreEmpresa as nombreEmpresa')->pluck('nombreEmpresa');
        $articulo = InvArticulo::select('id','articulo as text')->pluck('text','id');
        // $inventories_actives_codes= InvEspecificacion::selectRaw('id as id, especificacion as especificacion')->pluck('id','especificacion');
        return view('inventories/adquisicion.index',compact('articulo','nit','nombreEmpresa','bodega','tipos_de_entrada'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $empresas = InvProveedores::all();
        $tipos_de_entradas = InvTiposEntradas::all();
        $bodegas = InvBodegas::all();
        $estados = InvUsos::all();
        $nits = InvProveedores::select('nit as text','id')->pluck('text','id' );
        $nites = InvProveedores::all();
        $requerimientos = InvTiporequerimientos::all();
        $nombreEmpresa = InvProveedores::select('id','nombreEmpresa as nombreEmpresa')->pluck('id', 'nombreEmpresa');
        $articulos = InvArticulo::select('id','articulo as text')->pluck('text','id');
        $id_articulo = $request->get('id');
        return view ('inventories/adquisicion.create',compact('requerimientos','estados','articulos','nits','nombreEmpresa','bodegas','tipos_de_entradas'));
    }
    /**
     * @param  \App\InvAdquisicion  $invAdquisicion
     * @return \Illuminate\Http\Response
    */
        public function buscarProveedor (Request $request){
        $nombreEmpresa = InvProveedores::FindOrFail($request->id);
        return view('inventories.adquisicion.datosProveedor',compact('nombreEmpresa'));
        // return response()->json($nombreEmpresa);
        }
    /**
    * @param  \App\InvAdquisicion  $invAdquisicion
     * @return \Illuminate\Http\Response
    */
        public function buscarArticulo (Request $request){
            $articulo = InvArticulo::FindOrFail($request->id);
            return view('inventories.adquisicion.datosArticulo',compact('articulo'));
           //return response()->json($articulo);
            }
    /**
   * @param  \App\InvAdquisicion  $invAdquisicion
     * @return \Illuminate\Http\Response
    */
            public function buscarAtributo (Request $request){
                $atributo = InvArticuloAtributo::FindOrFail($request->id);
                print_r([$atributo]);
                return view('inventories.adquisicion.datosAtributo',compact('atributo'));
               //return response()->json($articulo);
                }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->activos as $key => $activo) {
        $articulo = InvArticulo::findOrFail($activo["id_articulo"]);
            for ($i=0; $i < $activo["cantidad"] ; $i++) {
                $activoGuardado = InvAdquisicion::create($request->merge($activo)->except(['activos']));
                $activoGuardado->codigo = $articulo->codigo.'-'.str_pad($activoGuardado->id, 7, "0", STR_PAD_LEFT);
                $activoGuardado->save();
            }
        }
       // dd($request->all());
        return back();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\InvAdquisicion  $invAdquisicion
     * @return \Illuminate\Http\Response
     */
    public function show(InvAdquisicion $invAdquisicion)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvAdquisicion  $invAdquisicion
     * @return \Illuminate\Http\Response
     */
    public function edit(InvAdquisicion $invAdquisicion)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvAdquisicion  $invAdquisicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvAdquisicion $invAdquisicion)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvAdquisicion  $invAdquisicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvAdquisicion $invAdquisicion)
    {
        //
    }
}
