<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function validateRequestUser($action = null,$data)
    {
        $check = true;
        if(!isset($data['first_name'])){
            return $this->responseError(500,'Invalid data first name!');
        }

        if(!isset($data['middle_name'])){
            return $this->responseError(500,'Invalid data middle name!');
        }

        if(!isset($data['last_name'])){
            return $this->responseError(500,'Invalid data last name!');
        }

        if(!isset($data['email'])){
            return $this->responseError(500,'Invalid data email!');
        }

        if((strlen($data['password']) < 3)){
            return $this->responseError(500,'Password must be at least 3 characters!');
        }

        if(!isset($data['user_name'])){
            return $this->responseError(500,'Invalid data user name!');
        }

        if($action == 'create') {
            $check = $this->checkFieldValueInDB('users','user_name',$data['user_name']);
            if($check) return $check;
            $check = $this->checkFieldValueInDB('users','email',$data['email']);
            if($check) return $check;
        }
        
        if($action == 'update') {

            if(!isset($data['user_id'])){
                return $this->responseError(500,'Some Thing Went Wrong Went You Try Edit This User');
            }

            $data_old_user = DB::table('users')->find($data['user_id']);

            if($data_old_user == null){
                return $this->responseError(500,"have not data of this user in Database");
            } else 
            {
                if($data['user_name'] !== $data_old_user->user_name)
                {
                    $check = $this->checkFieldValueInDB('users','user_name',$data['user_name']);
                    if($check) return $check;
                }

                if($data['email'] !== $data_old_user->email)
                {
                    $check = $this->checkFieldValueInDB('users','email',$data['email']);
                    if($check) return $check;
                }
            }
        }
        

        return true;
    }

    public function checkFieldValueInDB($table_name,$field_check, $value_check)
    {
        if(DB::table($table_name)->where($field_check, $value_check)->first() != null)
            return $this->responseError(500,$field_check.' be used!!');
        return true;
    }
}