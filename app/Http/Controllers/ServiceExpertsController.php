<?php

namespace App\Http\Controllers;

use App\ServiceexpertsFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceExpertsController extends Controller
{
    public function files(){
        $path_init = '/Home';

        $permissions =  [
            'filesupload'=> auth()->user()->hasPermissionTo('serviceexperts.filesupload'),
            'filesdelete'=> auth()->user()->hasPermissionTo('serviceexperts.filesdelete'),
        ];

        return view('serviceexperts.files',compact(['path_init','permissions']));
    }

    public function getDirectory(Request $request){
        $files = ServiceexpertsFile::where('directory',$request->dirpath)
        ->whereNotNull('path')
        ->orderBy('folder','DESC')
        ->get();
        return $files;
    }

    public function createDirectory(Request $request){
        $folders = ServiceexpertsFile::where('directory',$request->dir)
        ->where('name',$request->name)
        ->where('folder',1)
        ->get();

        if($folders->count()){
            return [
                'result' => 'exist',
                'message' => 'This folder already exists'
            ];
        }
        
        ServiceexpertsFile::create([
            'name'  =>  $request->name,
            'path'  =>  $request->dir.'/'.$request->name,
            'directory' => $request->dir,
            'folder'    => 1
        ]);


        return [
            'result' => 'created',
            'message' => 'Folder created successfully',
        ];
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
            'path' => $path,
            'directory' => $request->dir
        ]);
        return redirect()->route('serviceexperts.files')
        ->with('info', 'File upload successfully');
    }

    public function filesDownload(ServiceexpertsFile $file){
        if( Storage::exists($file->path)){
            return  Storage::download($file->path);
        }else{
            abort(404);
            // return response("",404);
        }

    }

    public function filesDelete(Request $request){

        $file = ServiceexpertsFile::where('id',$request->id)->get()->first();         

        

        function deleteDirectory($folder,$files = []){            
            $directory = ServiceexpertsFile::where('directory',$folder->path)->get();

            foreach ($directory as $fileDir) {
                if($fileDir->folder =='1'){
                    array_push($files,$fileDir);
                    $files =deleteDirectory($fileDir,$files);
                    $fileDir->delete();
                }else{
                    array_push($files,$fileDir);
                    Storage::delete($fileDir->path);
                    $fileDir->delete();
                }
            }
            return $files;
        }

        if($file->folder == '1'){
            deleteDirectory($file);
            $file->delete();
        }else{
            Storage::delete($file->path);
            $file->delete();
        }
        return 'success';
    }

}
