<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;
use App\InvProveedores;
use App\Status;

use function PHPSTORM_META\type;

class InvProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores= InvProveedores::all();

        return view ('inventories.proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores= InvProveedores::all();
        return view('inventories/proveedores.create', compact('proveedores'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosProv=request()->except('_token');
        InvProveedores::insert($datosProv);
      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $proveedores = InvProveedores::findOrFail($id);

        return view('inventories/proveedores.edit',compact('proveedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $datosProveedores = request()->except(['_token','_method']);
        InvProveedores::where('id','=',$id)->update($datosProveedores);
        $proveedores = InvProveedores::findOrFail($id);
        return view('inventories/proveedores.edit',compact('proveedores'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
