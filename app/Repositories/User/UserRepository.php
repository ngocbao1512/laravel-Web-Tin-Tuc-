<?php 
namespace App\Repositories\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;

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

        //$dataRole = array();//$data['roles']
        $Roles = isset($data['roles']) ? explode(",",$data['roles']) : 'writter';

        // TODO SOMETHING TO VALIDATE DATACREATE
        if($this->IsNullElementInArray($dataCreate) != null)
        {
            return $this->IsNullElementInArray($dataCreate)."null";
        }

        if($data['avatar'] != 'undefined'){
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

        // $newUser = new User($dataCreate)
        $newUser = $this->model->create($dataCreate);
        
        

        if($newUser)
        {
            /*$dataRole['user_id'] = $newUser->id;

            foreach ($Roles as $role) {
                // chỉ cập nhật bảng role_user
                //$newUser->roles->save($role);
                $dataRole['role_id'] = DB::table('roles')->where('name',$role)->value('id');

                DB::table('role_users')->updateOrInsert($dataRole);
            
            }*/
            foreach ($Roles as $role) {
                $newUser->roles->save($role);
            }

            return $newUser;
        }
        
        return false;
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

        $Roles = isset($data['roles']) ? explode(",",$data['roles']) : 'writter';

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
            $new_user = $user->update($dataCreate);
            if($new_user) {
                // delete tất cả các role có user_id = $new_user->id  xong rồi add lại giống ở function create 
                DB::table('role_users')->where('user_id', $new_user->id)->delete();
                
                foreach ($Roles as $role) {
                    $newUser->roles->save($role);
                }

                //return $this->model->find($dataCreate['user_id']);
                return $new_user;
            }
            return false;
        }
        return false;
    }

    public function delete($data)
    {        
        $userId = isset($data['user_id']) ? $data['user_id'] : '';

        if(!$userId)
        {
        return trans('user.some_thing_wrong_when.delete');
        }

        $user = $this->model->find($userId);
        if($user)
        {
            $user->delete();
            return true;
        }
        return trans('user.user_deleted_before');

    }  
}
