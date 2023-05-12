<?php

namespace App\Http\Controllers;

use App\invInactivos;
use Illuminate\Http\Request;
use App\InvArticulo;
use App\InvAtributo;

class InvInactivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activos = InvArticulo::orderBy('id','asc')->where('anulado','=','anulado')->paginate(100);
        return view ('inventories.inactivos.index',compact('activos'));
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
        $articulo = InvArticulo::create($request->all());
        $articulo->atributos()->sync($request->atributos);
        $request->session()->flash('alert-success', 'User was successful added!');

        return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invInactivos  $invInactivos
     * @return \Illuminate\Http\Response
     */
    public function show(invInactivos $invInactivos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invInactivos  $invInactivos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activos = InvArticulo::findOrFail($id);

        return view('inventories/inactivos.edit',compact('activos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invInactivos  $invInactivos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvArticulo $activo)
    {
        $activo->update($request->all());

        $activo->atributos()->sync($request->atributos);
      return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invInactivos  $invInactivos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = InvArticulo::findOrFail($id);
        $id->delete();
        return back()->with('info', 'Successfully removed');
    }
}
