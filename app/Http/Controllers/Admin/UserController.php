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
            if( $this->userRepository->create($data))
            {
                return $this->responseSuccess('Add User Succes',$data);
            }
            return false;
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError(400,"Add User Fail");
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
                return $this->responseError(500,'Invalid data user!');
            }

            $user = $this->userRepository->find($data['user_id']);
            if(is_null($user)){
                return $this->responseError(404,'User not found');
            }

            return $this->responseSuccess('find success',[
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
            if( $this->userRepository->update($data))
            {
            return $this->responseSuccess('update User Success',$data);
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
        return $this->responError(404,'some thing went wrong went you try delete this user');

        try {
            if($this->userRepository->delete($request) !== true)
            {
                return $this->responseError(404,$this->userRepository->delete($request));
            }
                return $this->responseSuccess('delete success');
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
