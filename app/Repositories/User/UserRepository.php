<?php 
namespace App\Repositories\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

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

    public function create($data)
    {
        $data = $request->only([
            'email',
            'password',
            'first_name',
            'middle_name',
            'last_name',
            'username',
            'avatar'
        ]);

        // TODO SOMETHING TO VALIDATE DATA
        

        $dataCreate = array(
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
            'first_name'    => isset($data['first_name']) ? $data['first_name'] : '',
            'middle_name'    => isset($data['middle_name']) ? $data['middle_name'] : '',
            'last_name'    => isset($data['last_name']) ? $data['last_name'] : '',
            'username'    => isset($data['username']) ? $data['username'] : '',
        );

        if(isset($data['avatar'])){
            if(is_string($data['avatar'])){

            }else{
                $file = Request::file('avatar');
                $image_name = encodeImage($file->hashName());
                $file->move('storage/avatar',$image_name);
                $dataCreate['avatar'] = $image_name;
            }
        }else{
            $dataCreate['avatar'] = 'image-default';
        } 
        return $this->model->create($dataCreate);
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
