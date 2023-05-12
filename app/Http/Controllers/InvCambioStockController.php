<?php

namespace App\Http\Controllers;

use App\invCambioStock;
use App\InvArticulo;
use App\invBajaStock;
use App\InvBodegas;
use Illuminate\Http\Request;

class InvCambioStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos= InvArticulo::all();
        $bodegas = InvBodegas::all();
        return view('inventories.cambios.create',compact('articulos','bodegas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datoscambios=request()->except('_token');
        //dump($datoscambios);
       //dd($datoscambios);
        invCambioStock::insert($datoscambios);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invCambioStock  $invCambioStock
     * @return \Illuminate\Http\Response
     */
    public function show(invCambioStock $invCambioStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invCambioStock  $invCambioStock
     * @return \Illuminate\Http\Response
     */
    public function edit(invCambioStock $invCambioStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invCambioStock  $invCambioStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invCambioStock $invCambioStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invCambioStock  $invCambioStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(invCambioStock $invCambioStock)
    {
        //
    }
}
