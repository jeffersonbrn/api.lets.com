<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\logPosition;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function listPackages()
    {
        $packages = Package::with('positions:id,name')->get();
        if (!$packages) {
            return response()->json([
                'message' => 'Not register found',
            ], 201);
        }
        return response()->json([
            'message' => 'List Packages',
            'packages' => $packages
        ], 201);
    }

    public function viewPackage($id)
    {
        $Package = Package::with('positions:id,name')->find($id);
        if (!$Package) {
            return response()->json([
                'message' => 'Not register found',
            ], 201);
        }
        return response()->json([
            'Package' => $Package
        ], 201);
    }

    public function createPackage(Request $request)
    {
        $args = $request->input();

        $validator = Validator::make($args, [
            'name' => 'required|string',
            'description' => 'required|string',
            'code_tracking' => 'required|string',
            'cep' => 'required|string',
            'road' => 'required|string',
            'number' => 'required|string',
            'district' => 'required|string',
            'complement' => 'nullable|string',
            'state' => 'required|string',
            'city' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Wrong of validation',
                'errors' => $validator->messages()
            ], 400);
        }

        $package = new Package();
        $package->fill($args);

        if (!$package->save()) {
            return response()->json([
                'message' => 'Wrong to save package',
                'package' => $package->fails()
            ], 500);
        }

        $package = Package::find($package->id);

        $position_id = $package->position_id;

        $LogPosition = new logPosition();
        $LogPosition->package_id = $package->id;
        $LogPosition->position_id = $position_id;   

        if (!$LogPosition->save()) {
            return response()->json([
                'message' => 'Wrong to update information package',
                'LogPosition' => $LogPosition->fails()
            ], 500);
        }  

        return response()->json([
            'message' => 'Package successfully registered',
            'package' => $package
        ], 201);
    }

    public function updatePackage(Request $request, $id)
    {
        $packages = Package::all();
        $package = $packages->find($id);

        if (!$package) {
            return response()->json([
                'message' => 'Not register found',
            ], 201);
        };

        $args = $request->input();

        $validator = Validator::make($args, [
            'name' => 'required|string',
            'description' => 'required|string',
            'code_tracking' => 'required|string',
            'cep' => 'required|string',
            'road' => 'required|string',
            'number' => 'required|string',
            'district' => 'required|string',
            'complement' => 'nullable|string',
            'state' => 'required|string',
            'city' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Wrong of validation',
                'errors' => $validator->messages()
            ], 400);
        }

        $package->fill($args);

        if (!$package->save()) {
            return response()->json([
                'message' => 'Wrong to save package',
                'package' => $package->fails()
            ], 500);
        }

        return response()->json([
            'message' => 'package successfully registered',
            'package' => $package
        ], 201);
    }

    public function deletepackage($id)
    {
        $package = Package::where('id', $id)->delete();
        if (!$package) {
            return response()->json([
                'message' => "not register found",
            ], 201);
        }
        return response()->json([
            'message' => "Register successfully delete",
        ], 200);
    }

    public function updatePackagePosition(Request $request, $id)
    {
        $package_id = $id;
        $packages = Package::all();

        $package = $packages->find($package_id);
  
        $package->position_id = $request->position_id;

        if (!$package->save()) {
            return response()->json([
                'message' => 'Wrong to update information package',
                'package' => $package->fails()
            ], 500);
        }

        //Save the logPosition
        $LogPosition = new logPosition();
        $LogPosition->package_id = $package_id;
        $LogPosition->position_id = $package->position_id;

        if (!$LogPosition->save()) {
            return response()->json([
                'message' => 'Wrong to update information package',
                'LogPosition' => $LogPosition->fails()
            ], 500);
        }

        return response()->json([
            'message' => "Position successfully update",
        ], 201);
    }
}
