<?php

namespace App\Http\Controllers;

use App\ServiceexpertsFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceExpertsController extends Controller
{
    public function files(){

        $files = ServiceexpertsFile::get();
        return view('serviceexperts.files',compact('files'));
    }

    public function filesUpload(){
        return view('serviceexperts.filesUpload');
    }

    public function filesUploadStore(Request $request){
        $request->validate([
            'file' => 'required'
        ]);

        $name = $request->file('file')->getClientOriginalName();
        
        $path = $request->file->store('storage/serviceexperts');

        ServiceexpertsFile::create([
            'name' => $name,
            'path' => $path
        ]);
        return redirect()->route('serviceexperts.files')
        ->with('info', 'File upload successfully');
    }

    public function filesDownload(ServiceexpertsFile $file){
        return  Storage::download($file->path);
    }

    public function filesDelete(ServiceexpertsFile $file){
        Storage::delete($file->path);
        $file->delete();
        return redirect()->route('serviceexperts.files')
        ->with('info', 'File delete successfully');
    }

}
