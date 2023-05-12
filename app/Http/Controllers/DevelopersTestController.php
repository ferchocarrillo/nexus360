<?php

namespace App\Http\Controllers;

use App\DevelopersTest;
use App\Kaizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevelopersTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kaizens = Kaizen::where('group', 'Development')->get();

        $test = DB::table('developers_tests')
        ->select('idCase')
        ->where('idCase', $kaizens)
        ->get();
        //dd($kaizens['id']);
        return view('developers.testLab.index', compact('kaizens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$kaizens = Kaizen::where('group', 'Development')->get()->pluck('id');
        //return view('developers.testLab.create', compact('kaizens'));
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
     * @param  \App\DevelopersTest  $developersTest
     * @return \Illuminate\Http\Response
     */
    public function show(DevelopersTest $developersTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DevelopersTest  $developersTest
     * @return \Illuminate\Http\Response
     */
    public function edit(DevelopersTest $developersTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DevelopersTest  $developersTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DevelopersTest $developersTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DevelopersTest  $developersTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(DevelopersTest $developersTest)
    {
        //
    }
}
