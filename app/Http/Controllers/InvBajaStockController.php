<?php

namespace App\Http\Controllers;

use App\InvAdquisicion;
use App\InvArticulo;
use App\InvAsignacion;
use App\invBajaStock;
use App\InvBodegas;
use App\MasterFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InvBajaStockController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:inventories.bajas.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $asignados = InvAsignacion::where('id', '<>', NULL)->orderBy('id', 'desc')->paginate(10);
        // $bajas = ["Daño Lógico" => "Daño Lógico", "Perdida" => "Perdida", "otros" => "otros"];
        return view('inventories.bajas.index', compact('asignados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos = InvArticulo::select('id', 'articulo as text')->pluck('text', 'id');
        $bodegas = InvBodegas::all();
        return view('inventories.bajas.create', compact('articulos', 'bodegas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'id_adquisicion'=>'required',
            'motivo' => 'required|in:Daño Lógico,Perdida,Reintegro',
            'observacion' => 'required|max:255'
        ],[
            'id_adquisicion.required'=> 'El id del artículo es obligatorio',
            'motivo.required'=> 'El motivo de la baja es obligatoria',
            'motivo.in'=> 'El motivo ":input" no es válido',
            'observacion.required'=> 'La observacion es obligatoria',
            'observacion.max'=> 'La observacion no puede superar los 255 carácteres',
        ]);

        $activo = InvAdquisicion::findOrFail($request->id_adquisicion);
        $id_asignacion = $activo->id_asignacion;
        if($request->motivo == 'Reintegro'){
            $activo->id_asignacion = NULL;
        }else{
            $activo->id_asignacion = NULL;
            $activo->baja = 1;
        }

        $activo->save();
        invBajaStock::create($request->merge([
            'articulo' => $activo->codigo,
            'id_asignacion' => $id_asignacion
        ])->all());

        return back()->with('info', 'El articulo se ha reintegrado exitosamente al stock');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invBajaStock  $invBajaStock
     * @return \Illuminate\Http\Response
     */
    public function show(invBajaStock $invBajaStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invBajaStock  $invBajaStock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activo = InvAdquisicion::findOrFail($id);
        if($activo->id_asignacion){
            $bajas = ["Daño Lógico" => "Daño Lógico", "Perdida" => "Perdida", "Reintegro" => "Reintegro"];
        }else{
            $bajas = ["Daño Lógico" => "Daño Lógico", "Perdida" => "Perdida"];
        }

        if($activo->baja){
            return redirect('inventories/asignacion')->with('error','El activo no está disponible en stock');
        }
        // $datosAsignado = DB::table('master_files') ->where( $id,'master_files.id')->first();



        return view('inventories.bajas.edit', compact('bajas', 'activo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invBajaStock  $invBajaStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invBajaStock $invBajaStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invBajaStock  $invBajaStock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        InvAsignacion::destroy($id);
        return back()
            ->with('status_success', 'registro successfully removed');
    }
}
