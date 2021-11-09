<?php 
namespace App\Repositories\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    // lay model tuong ung 
    public function __construct()
    {
        parent::__contruct();
        
    }

    public function getModel()
    {
        return \App\Models\User::class;
    }

    
}
