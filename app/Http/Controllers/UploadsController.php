<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UploadsController extends Controller
{
    public function ListUploads($id)
    {
        $Uploads = Upload::where('package_id', $id)->get();
        if (!$Uploads) {
            return response()->json([
                'message' => 'Not register found',
            ], 201);
        }
        return response()->json([
            'message' => 'List Uploads',
            'packages' => $Uploads
        ], 201);
    }

    public function uploadFile(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,doc,docx,pdf,txt,csv|max:4096' 
        ]);

        if($validator->fails()) {
            return response()->json(['status' => 'Failed', 'message' => "Validation error", "errors" => $validator->errors()]);
        }

        try {
            if ($request->hasFile('file')) {

                $file = $request->file('file');
                 
                // get File
                $file       = $request->file('file');
                // get Name
                $name   = $file->getFileName();
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
                ], 200);         
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),Response::HTTP_NOT_FOUND);
        }  
    }
}
