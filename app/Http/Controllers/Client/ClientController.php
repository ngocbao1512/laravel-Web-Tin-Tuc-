<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function validate_comment($data)
    {
        if(!isset($data['email'])){
            return $this->responseError(500,trans('general.your_email_is_null'));
        }

        if(!isset($data['user_name'])) {
            return $this->responseError(500,trans('general.your_user_name_is_null'));
        }

        if(!isset($data['content'])) {
            return $this->responseError(500,trans('general.your_comment_is_null'));
        }

        
        
    }
}
