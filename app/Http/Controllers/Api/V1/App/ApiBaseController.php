<?php

namespace App\Http\Controllers\Api\V1\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiBaseController extends Controller
{
    public function sendError($message, $status = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $status);
    }

    public function sendResponse($data, $message = "", $status = 200)
    {
        return response()->json([
            'data' => $data,
            'success' => true,
            'message' => $message
        ], $status);
    }

    public function catchall()
    {
        return response('', 200);
    }
}
