<?php

namespace App\Http\Controllers;

use App\InvActivos;
use App\InvArticulo;
use App\InvAtributo;
use App\inventories_vendors;
use App\InvProveedores;
use Illuminate\Http\Request;

class InvActivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activos = InvArticulo::orderBy('id','asc')->where('anulado','=','activo')->paginate(100);
        return view ('inventories.activos.index',compact('activos'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $atributos = InvAtributo::get();
        return view('inventories.activos.create',compact('atributos'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , InvArticulo $activo)
    {
        //dd($request->all());
        $validated = $request->validate([
            'articulo' => 'required|max:250|unique:inv_articulos,articulo,'.$activo->id,
            'codigo' => 'required|max:6'.$activo->id,
        ]);

        $articulo = InvArticulo::create($request->all());


        $articulo->atributos()->sync($request->atributos);
        //dd($datosactivos);
        return back();
    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $activos = InvArticulo::orderBy('id','asc')->where('anulado','<>','anulado')->paginate(100);
        return view ('inventories.activos.list',compact('activos'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(InvArticulo $activo)
    {
        $atributos = InvAtributo::get();
        //dd($activo);
        return view('inventories.activos.edit', compact(['activo','atributos']));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvArticulo $activo)
    {


        $activo->update($request->all());
        $activo->atributos()->sync($request->atributos);
        return back();
        // return view('inventories.activos.edit', compact('activos'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = InvArticulo::findOrFail($id);
        $id->delete();
        return back()->with('info', 'Successfully removed');
    }
}
