<?php 
namespace App\Repositories\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    // lay model tuong ung 
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getUserName()
    {
        return $this->model->select('username')->take(5)->get();
    }
}
