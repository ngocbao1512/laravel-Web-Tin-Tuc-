<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $data;
    
    public function __construct(Request $request = null)
    {
        if(is_null($request)){
            $this->data = [];
        }else{
            $this->data = array_merge($request->all(), $request->json()->all());
        }
    }
}
