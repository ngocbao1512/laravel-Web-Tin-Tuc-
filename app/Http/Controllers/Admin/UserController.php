<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends AdminController
{
    protected $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository;
    }

    public function index()
    {
        return view('admin.user.index',[
            'users' => $this->userRepository->getAll(),
        ]);   
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // validate
        if($this->validateRequestUser('create',$data) !== true)
        {
            return $this->validateRequestUser('create',$data);
        }

        try {
            $new_user = $this->userRepository->create($data);
            if($new_user)
            {
                return $this->responseSuccess(trans('user.add_success'),[
                    'new_row' => view('admin.user.user-collumn',[
                        'user' => $new_user,
                    ])->render(),  
                ]);
                
            }
            return false;
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError(400,trans('user.fail.add'));
        }
    }

    public function show($id)
    {
        return view('admin.user.show',[
            'user' => $this->userRepository->find($id),
        ]);
    }

    public function find(Request $request)
    {
        try {

            $data = $request->all();
            if(!isset($data['user_id'])){
                return $this->responseError(500,trans('user.invalid_data.user'));
            }
            
            $user = $this->userRepository->find($data['user_id']);
            if(is_null($user)){
                return $this->responseError(404,trans('user.no_data_user'));
            }

            return $this->responseSuccess(trans('user.find_success'),[
                'user_form' => view('admin.user.user-form',[
                    'user' => $user,
                ])->render(),  
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError($e);
        }
    }

    public function update(Request $request)
    {
        $data = $request->all();

        // validate data 
        if($this->validateRequestUser('update',$data) !== true)
        {
            return $this->validateRequestUser('update',$data);
        }
        
        try {
            $new_user = $this->userRepository->update($data);
            if($new_user)
            {
            return $this->responseSuccess(trans('user.update_success'),[
                'new_row' => view('admin.user.user-collumn',[
                    'user' => $new_user,
                ])->render(),  
            ]);
            }
            return false;
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError($e);
        }
        
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        if(!$data['user_id'])
        return $this->responError(404,trans('user.some_thing_wrong_when.delete'));

        try {
            if($this->userRepository->delete($request) !== true)
            {
                return $this->responseError(404,$this->userRepository->delete($request));
            }
                return $this->responseSuccess(trans('user.delete_success'));
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError($e);
        }
    }

    public function getModal(Request $request)
    {
        $data = $request->all();

        $urlmodal = isset($data['urlmodal']) ? $data['urlmodal'] : 'admin.user.formcreateuser';
        
        return view("$urlmodal")->render();
    } 
}
