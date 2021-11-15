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
        $dataCreate = array(
            'email'         => isset($data['email']) ? $data['email'] : '',
            'password'      => bcrypt($data['password']),
            'first_name'    => isset($data['first_name']) ? $data['first_name'] : '',
            'middle_name'    => isset($data['middle_name']) ? $data['middle_name'] : '',
            'last_name'    => isset($data['last_name']) ? $data['last_name'] : '',
            'user_name'    => isset($data['user_name']) ? $data['user_name'] : '',
        );

        // TODO SOMETHING TO VALIDATE DATACREATE
        if($this->IsNullElementInArray($dataCreate) != null)
        {
            return $this->IsNullElementInArray($dataCreate);
        }


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

    public function update($data)
    {
        $dataCreate = array(
            'email'         => isset($data['email']) ? $data['email'] : '',
            'password'      => bcrypt($data['password']),
            'first_name'    => isset($data['first_name']) ? $data['first_name'] : '',
            'middle_name'    => isset($data['middle_name']) ? $data['middle_name'] : '',
            'last_name'    => isset($data['last_name']) ? $data['last_name'] : '',
            'user_name'    => isset($data['user_name']) ? $data['user_name'] : '',
            'user_id' => isset($data['user_id']) ? $data['user_id'] : '',
        );

        // TODO SOMETHING TO VALIDATE DATACREATE
        if($this->IsNullElementInArray($dataCreate) != null)
        {
            return $this->IsNullElementInArray($dataCreate);
        }

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

        $user = $this->model->find($dataCreate['user_id']);

        if($user)
        {
            $user->update($dataCreate);
            return true;
        }
        return false;
    }

    public function delete($data)
    {        
        $userId = isset($data['user_id']) ? $data['user_id'] : '';

        if(!$userId)
        {
        return 'some thing went wrong went you try delete this user';
        }

        $user = $this->model->find($userId);
        if($user)
        {
            $user->delete();
            return true;
        }
        return 'This user has been deleted before';

    }  
}
