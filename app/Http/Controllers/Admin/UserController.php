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
        try {
            $newUser = $this->userRepository->create($request);
            return $this->responseSuccess('Add User Success', $newUser);
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError($e);
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
            return $this->responseSuccess('find success',[
                'user_form' => view('admin.user.formedituser',[
                    'user' => $this->userRepository->find($request->all()),
                ])->render(),
                
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError($e);
        }
    }

    public function update(Request $request)
    {
        try {
            $this->userRepository->update($request);
            return $this->responseSuccess('update User Success');
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError($e);
        }
        
    }

    public function destroy(Request $request)
    {
        try {
            if($this->userRepository->delete($request))
            {
            return $this->responseSuccess('delete success');
            }
            return false;
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
