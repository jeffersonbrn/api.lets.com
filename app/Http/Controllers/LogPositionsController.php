<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logPosition;

class LogPositionsController extends Controller
{
    public function listLogs($id)
    {
        $Logs = logPosition::with('positions:id,name')->where('package_id', $id)->get();
        if (!$Logs) {
            return response()->json([
                'message' => 'Not register found',
            ], 201);
        }
        return response()->json([
            'message' => 'List Logs',
            'packages' => $Logs
        ], 201);
    }
}
