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
            'first_name',
            'middle_name',
            'last_name',
            'email',
            'password',
            'username',
        ]);

        try {
            $newUser = $this->modelUser->create($data);
            return $this->responseSuccess($newUser, 'Add User Success');
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError($e);
        }
        
    }

    public function show($id)
    {
        $user = $this->modelUser->findOrFail($id);

        return view('admin.user.show',[
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        
        $userId = isset($data['user_id']) ? $data['user_id'] : 0;
        $userId = 0;
        $user = $this->modelUser->find($userId);

        if(is_null($user)){
            return $this->responseError(404, "User not found");
        }
        dd($user);
        try {
            $user->delete();

            return responseSuccess(null,'delete success');
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError($e);
        }
    }
}
