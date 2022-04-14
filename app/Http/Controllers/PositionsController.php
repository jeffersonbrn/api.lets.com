<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Validator;

class PositionsController extends Controller
{
    public function listPositions(Request $request)
    {
        $positions = Position::all();
        if (!$positions) {
            return response()->json([
                'message' => 'Not register found',
            ], 201);
        }
        return response()->json([
            'message' => 'List Positions',
            'position' => $positions
        ], 201);
    }

    public function viewPosition($id)
    {
        $position = Position::find($id);
        if (!$position) {
            return response()->json([
                'message' => 'Not register found',
            ], 201);
        }
        return response()->json([
            'position' => $position
        ], 201);
    }

    public function createPosition(Request $request)
    {
        $args = $request->input();

        $validator = Validator::make($args, [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Wrong of validation',
                'errors' => $validator->messages()
            ], 400);
        }

        $position = new Position();
        $position->fill($args);

        if (!$position->save()) {
            return response()->json([
                'message' => 'Wrong to save package',
                'position' => $position->fails()
            ], 500);
        }

        return response()->json([
            'message' => 'Position successfully registered',
            'position' => $position
        ], 201);
    }

    public function updatePosition(Request $request, $id)
    {
        $positions = Position::all();
        $position = $positions->find($id);

        if (!$position) {
            return response()->json([
                'message' => 'Not register found',
            ], 201);
        };

        $args = $request->input();

        $validator = Validator::make($args, [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Wrong of validation',
                'errors' => $validator->messages()
            ], 400);
        }

        $position->fill($args);

        if (!$position->save()) {
            return response()->json([
                'message' => 'Wrong to save package',
                'position' => $position->fails()
            ], 500);
        }

        return response()->json([
            'message' => 'Position successfully registered',
            'position' => $position
        ], 201);
    }

    public function deletePosition($id)
    {
        $position = Position::where('id', $id)->delete();
        if (!$position) {
            return response()->json([
                'message' => "not register found",
            ], 201);
        }
        return response()->json([
            'message' => "Register successfully delete",
        ], 201);
    }
}
