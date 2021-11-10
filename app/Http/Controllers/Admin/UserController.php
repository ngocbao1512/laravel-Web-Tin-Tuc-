<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
        )
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('admin.user.index',[
            'users' => $this->userRepository->getAll(),
        ]);   
    }

    public function store(Request $request)
    {
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
        $data = $request->all();

        return $this->responseSuccess('find success',$this->userRepository->find($userId));

    }

    public function update(Request $request, $id)
    {
        
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
}
