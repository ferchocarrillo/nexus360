<?php

namespace App\Http\Controllers;

use App\InvAdquisicion;
use App\InvArticulo;
use Illuminate\Http\Request;
use App\InvProveedores;
use App\InvBodegas;
use App\InvTiporequerimientos;
use App\InvUsos;
use App\InvAsignacion;
use App\User;
use App\MasterFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use stdClass;

class InvAsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // dd($this->authorize('haveaccess', 'inventories.destroy'));
        $complementos = InvAsignacion::select('full_name', 'position', 'campaign', 'phone_number', 'supervisor', 'wave', 'site')->get();
        $motivos = ["Nueva Contratación" => "Nueva Contratación", "Nueva Asignación" => "Nueva Asignación"];
        $articulos = InvAdquisicion::whereNull('anulado')
        ->whereNull('id_asignacion')
        ->select('codigo', 'articulo')
        ->get();


        // $articulos = InvAdquisicion::select('id', 'codigo as text')->pluck('text', 'id');
        $employess = MasterFile::where('status', 'Active')->select('national_id', 'full_name')->get();
        return view('inventories/asignacion.index', compact('employess', 'articulos', 'motivos', 'complementos'));
    }
    public function findEmployee(Request $request)
    {
        $employee = MasterFile::where('national_id', $request->national_id)
            ->where('status', 'Active')
            ->select(
                'id',
                'full_name',
                'position',
                'campaign',
                'supervisor',
                DB::raw("'' as phone_number"),
                DB::raw("'' as site"),
                DB::raw("'' as wave")
            )
            ->firstOrFail();
        return view('inventories.asignacion.datosResponsable', compact('employee'));
    }
    public function employeeAssignations(Request $request)
    {


        $assignations = InvAsignacion::where('national_id', $request->national_id)->get();
        return view('inventories.asignacion.asignacionesResponsable', compact('assignations'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $empresas = InvProveedores::all();
        $estados = InvUsos::all();
        $nits = InvProveedores::select('nit as text', 'id')->pluck('text', 'id');
        $nites = InvProveedores::all();
        $requerimientos = InvTiporequerimientos::all();
        $bodegas = InvBodegas::all();
        $nombreEmpresa = InvProveedores::select('nombreEmpresa as nombreEmpresa')->pluck('nombreEmpresa');
        $articulos = InvArticulo::select('id', 'articulo as text')->pluck('text', 'id');
        $user_ids = User::select('id', 'name as text', 'national_id as id_user')->pluck('id_user', 'id', 'text');
        return view('inventories/asignacion.create', compact('user_ids', 'bodegas', 'articulos', 'nits', 'nombreEmpresa'));
    }
    // /**
    //  * @param  \App\InvAdquisicion  $invAdquisicion
    //  * @return \Illuminate\Http\Response
    //  */
    // public function buscarArticulo(Request $request)
    // {
    //     $articulo = InvArticulo::FindOrFail($request->id);
    //     return view('inventories.adquisicion.datosArticulo', compact('articulo'));
    //     //return response()->json($articulo);
    // }
    /**
     * @param  \App\InvAdquisicion  $invAdquisicion
     * @return \Illuminate\Http\Response
     */
    public function buscarAsignacion(Request $request)
    {
        $asignacion = InvArticulo::FindOrFail($request->id);
        return view('inventories.adquisicion.buscarAsignacion', compact('asignacion'));
        //return response()->json($articulo);
    }
    /**
     * @param  \App\InvAdquisicion  $invAdquisicion
     * @return \Illuminate\Http\Response
     */
    public function buscarResponsable(Request $request)
    {
        $user_ids = User::FindOrFail($request->id);
        //dd($user_ids);
        return view('inventories.asignacion.datosResponsable', compact('Responsable'));
        //return response()->json($user_ids);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'articulo' => 'required|unique:inv_asignacions|max:255',
        ]);
        if ($validator->fails()) {
            return back()->with('error','No se asignaran articulos ya registrados previamente');
        }
        $employee = MasterFile::where('national_id', $request->national_id)
            ->where('status', 'Active')
            ->select(
                'id AS employee_id',
                'full_name',
                'position',
                'campaign',
                'supervisor',
                DB::raw("'' as phone_number"),
                DB::raw("'' as site"),
                DB::raw("'' as wave")
            )
            ->firstOrFail()->toArray();
        $datosAdquisicion = $request->merge($employee)->all();

        //dd($datosAdquisicion);
        $asignacion = InvAsignacion::create($datosAdquisicion);
        $activo = InvAdquisicion::where('codigo',$request->articulo)->firstOrFail();
        $activo->id_asignacion = $asignacion->id;
        $activo->save();
        return back()->with('info', 'Se asignó el activo exitosamente');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\InvAsignacion  $invAsignacion
     * @return \Illuminate\Http\Response
     */
    public function show(InvAsignacion $invAsignacion)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvAsignacion  $invAsignacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asignado = InvAdquisicion::findOrFail($id);
        $usuarios = MasterFile::select('national_id as id')->orderBy('id', 'desc')->pluck('id');
        return view('inventories/asignacion.edit', compact('asignado', 'usuarios'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvAsignacion  $invAsignacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvAsignacion  $invAsignacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvAsignacion $invAsignacion)
    {
        //
    }
    public function findArticulo(Request $request)
    {
        $activo = InvAdquisicion::where('codigo', $request->articulo)->firstOrFail();

        // return response()->json($request->all());

        return "<input type='hidden' value='$activo->id' name='id_activo' />";
        return response()->json($activo);
        $html = '';
        foreach ($activo as $key) {
            $html .= "<option value='" . $key['codigo'] . "'>" . $key['atributos'] . "</option>";
        }
        return response()->json($activo);
    }
}
