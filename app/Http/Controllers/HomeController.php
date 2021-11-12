<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function changeLanguage(Request $request)
    {
        \Session::put('website_language', $request->all());

        return 'ok';
    }
}
