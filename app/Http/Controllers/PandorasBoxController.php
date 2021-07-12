<?php

namespace App\Http\Controllers;

use App\Mail\PandorasBoxMail;
use App\PandorasBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PandorasBoxController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:pandorasbox')->only(['index','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pandorasbox.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pandora = PandorasBox::create([
            'suggestion'=>$request->suggestion,
            'category'=>$request->category,
            'created_by'=>Auth::user()->id
        ]);
        Mail::to([
            'paula.arciniegas@cp-360.com',
            'kelly.gamez@cp-360.com',
            'katherine.olarte@cp-360.com',
            'harold.penagos@cp-360.com',
            'juand.cuellar@cp-360.com',
        ])->send(new PandorasBoxMail($pandora));
        
        return redirect()->back()->with('info', 'Created successfully');
    }

}
