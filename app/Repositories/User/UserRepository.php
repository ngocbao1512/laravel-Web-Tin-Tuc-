<?php 
namespace App\Repositories\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    // lay model tuong ung 
    public function __construct()
    {
        parent::__construct();
        
    }

    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function create($request)
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

        return $this->model->create($data);
    }

    public function update($request)
    {
        $userId = isset($request->user_id) ? $request->user_id : 0;
        $result = $this->model->find($userId);
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
        }

        if($result)
        {
            $result->update($data);
            return true;
        }
        return false;
    }

    public function delete($request)
    {        
        $userId = isset($request->user_id) ? $request->user_id : 0;

        $result = $this->model->find($request->user_id);
        if($result)
        {
            $result->delete();
            return true;
        }
        return false;

    }



    
}
