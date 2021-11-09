<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseSuccess($message='success', $data = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'status'=> 200
        ]);

    }

    public function responseError($statusCode=400,  $message='some thing went wrongsss', $data = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'status' => $statusCode
        ]);
    }
}
