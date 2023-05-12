<?php

namespace App\Http\Controllers;

use App\InvAdquisicion;
use App\invTrasladoStock;
use App\invCambioStock;
use App\InvArticulo;
use App\invBajaStock;
use App\InvBodegas;
use Illuminate\Http\Request;
use App\InvAsignacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class InvTrasladoStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignados = InvAdquisicion::where('id', '<>', NULL)->orderBy('id', 'asc')->paginate(10);


        // $bajas = ["Daño Lógico" => "Daño Lógico", "Perdida" => "Perdida", "otros" => "otros"];
        return view('inventories.traslado.index', compact('asignados'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos = InvArticulo::all();
        $bodegas = InvBodegas::all();
        return view('inventories.traslado.create', compact('articulos', 'bodegas'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bodegas = InvAdquisicion::where('id_articulo', $request->articulo)
            ->where('baja', 0)
            ->select(
                'id',
                'site',
            )
            ->firstOrFail()->toArray();
        $datosAdquisicion = $request->merge($bodegas)->all();
        //dd($datosAdquisicion);
        $asignacion = InvAsignacion::create($datosAdquisicion);
        $activo = InvAdquisicion::where('codigo', $request->articulo)->firstOrFail();
        $activo->id_asignacion = $asignacion->id;
        $activo->save();
        return back()->with('info', 'Se asignó el activo exitosamente');
        // $datostraslado = request()->except('_token');
        // //dump($datoscambios);
        // //dd($datoscambios);
        // invTrasladoStock::create($datostraslado);
        // return back();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\invTrasladoStock  $invTrasladoStock
     * @return \Illuminate\Http\Response
     */
    public function show(invTrasladoStock $invTrasladoStock)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invTrasladoStock  $invTrasladoStock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $activo = InvAdquisicion::findOrFail($id);
        $bodegas = InvBodegas::select('bodega as id','bodega as text')->toBase()->get()->pluck('id','text');
        return view('inventories.traslado.edit', compact('activo', 'bodegas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invTrasladoStock  $invTrasladoStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,InvAdquisicion $traslado)
    {
        $request->validate([
            'bodega'=>'required'
        ]);
        $traslado->bodega = $request->bodega;
        $traslado->save();

        return back()->with('info','Se trasladó correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invTrasladoStock  $invTrasladoStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(invTrasladoStock $invTrasladoStock)
    {
        //
    }
}
