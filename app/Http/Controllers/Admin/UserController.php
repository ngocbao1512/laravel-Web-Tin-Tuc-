<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function index()
    {
        return view('admin.user.index',[
            'users' => $this->userRepository->getAll(),
        ]);   
    }

    public function store()
    {
        $data = $this->data;
        dd($data);

        $file = $request->file;
        if($file)
        {
            $image_name = encodeImage($file->hashName());
            $file->move('storage/avatar',$image_name);
            $data['avatar'] = $image_name;
        }else{
            $data['avatar'] = 'image-default';
        }

        try {
            $newUser = $this->userRepository->create($data);
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
        $userId = $request->userid;

        return $this->responseSuccess('find success',[
            'user_form' => view('admin.user.formedituser',[
                'user' => $this->userRepository->find($userId),
            ])->render(),
            
        ]);

    }

    public function update(Request $request)
    {
        $userid = $request->userid;

        $data = $request->only([
            'email',
            'password',
            'first_name',
            'middle_name',
            'last_name',
            'username',
        ]);

        $file = $request->file;
        if($file)
        {
            $image_name = encodeImage($file->hashName());
            $file->move('storage/avatar',$image_name);
            $data['avatar'] = $image_name;
        }else{
            $data['avatar'] = 'image-default';
        }

        try {
            $this->userRepository->update($userid,$data);
            return $this->responseSuccess('update User Success');
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError($e);
        }
        
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        
        $userId = isset($data['user_id']) ? $data['user_id'] : 0;

        
        try {
            // $this->userRepository->delete($userId);

            return $this->responseSuccess('delete success',[
                'user_form' => view('admin.user.show',[
                    'user' => $this->userRepository->find($userId),
                ])->render(),
            ]);
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
