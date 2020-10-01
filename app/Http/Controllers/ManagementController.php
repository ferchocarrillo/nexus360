<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    public function uploadMasterfile(){
        return view('management.masterfile.upload');
    }

    public function uploadMasterfilePost(Request $request){
        $request->validate([
            'MasterFile' => 'required'
        ]);
        $filename = pathinfo(request()->MasterFile->getClientOriginalName(), PATHINFO_FILENAME) . '.' . request()->MasterFile->getClientOriginalExtension();
        request()->MasterFile->move(config('app.path_imports_sql').'masterfile',$filename);
        $data = DB::select('SET NOCOUNT ON EXEC spImportMasterFile');
        return redirect()->back()->with('data',$data);
    }
}
