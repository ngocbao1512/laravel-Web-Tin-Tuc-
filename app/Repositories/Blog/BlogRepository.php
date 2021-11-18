<?php
namespace App\Repositories\Blog;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use App\Models\Blog;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
        
    }

    public function getModel()
    {
        return \App\Models\Blog::class;
    }

    public function create($data)
    {    
        $dataCreate = array(
            'title'         => isset($data['title']) ? $data['title'] : '',     
            'content'      => isset($data['content']) ? $data['content'] : '',
            'cover'    => isset($data['cover']) ? $data['cover'] : '',
            'created_user_id' => isset($data['author']) ? $data['author'] : 1, 
            'publish_date'    => isset($data['publish_date']) ? $data['publish_date'] : '',
        );

        // TODO SOMETHING TO VALIDATE DATACREATE
        if($this->IsNullElementInArray($dataCreate) != null)
        {
            return $this->IsNullElementInArray($dataCreate)." is null";
        }


        if(isset($data['cover'])){
            if(is_string($data['cover'])){

            }else{
                $file = Request::file('cover');
                $image_name = encodeImage($file->hashName());
                $file->move('storage/cover',$image_name);
                $dataCreate['cover'] = $image_name;
            }
        }else{
            $dataCreate['cover'] = 'image-default';
        } 

        $newBlog = $this->model->create($dataCreate);

        if($newBlog)
            return $newBlog;
        return false;
    }




}