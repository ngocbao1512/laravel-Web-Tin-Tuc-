<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data;

    public function __contruct(Request $request = null)
    {
        if(is_null($request)){
            $this->data = [];
        }else{
            $this->data = array_merge($request->all(), $request->json()->all());
        }
    }

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
