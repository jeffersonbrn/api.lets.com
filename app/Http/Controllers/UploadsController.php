<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UploadsController extends Controller
{
    public function uploadFile(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,doc,docx,pdf,txt,csv|max:4096' 
        ]);

        try {
            if ($request->hasFile('files')) {

                $file = $request->file('file');
                 
                // get File
                $file       = $request->file('files');
                // get Name
                $name   = $file->getClientOriginalName();
                //Save on directory
                $path  =  $file->store('public/files');
    
                $Upload = new Upload();
                $Upload->create(['package_id' => $id,
                'name' => $name,
                'type'=> $file->extension(),
                'path'=>$path,
                'type_file'=> $file->extension()]);
    
                return response()->json([
                    'message' => "Upload successfully",
                ], 201);         
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),Response::HTTP_NOT_FOUND);
        }  
    }
}
