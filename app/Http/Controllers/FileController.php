<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    //

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $dataSourceIsFile = env("DATA_DRIVER") == DATABASE_SOURCE ?  false : true;

        return view('uploadForm',[
            'dataSourceIsFile' => $dataSourceIsFile
        ]);
    }

    public function uploadFile(Request $req){
        $validator = Validator::make($req->all(), [
            'file' => 'required|file|mimes:csv,txt|max:4048'
        ]);


        if ($validator->fails()) {
            return response()->json(['status'=>"error", "error"=>$validator->errors()], 422);
        }

        if($req->file != ""){
            $filename = DATASOURCE_FILENAME. ".". $req->file->clientExtension();

            $req->file("file")->storeAs(DocumentPath, $filename);

            return response()->json(['status'=>"ok"], 200);
        }
        return response()->json(['status'=>"error "], 200);
    }
}
