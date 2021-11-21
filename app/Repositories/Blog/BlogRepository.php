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
            'created_user_id' => isset($data['author_id']) ? $data['author_id'] : 1, 
            'publish_date'    => isset($data['publish_date']) ? $data['publish_date'] : '',
            );

        // TODO SOMETHING TO VALIDATE DATACREATE
        if($this->IsNullElementInArray($dataCreate) != null)
        {
            return $this->IsNullElementInArray($dataCreate)." is null";
        }


        if($data['cover'] != 'undefined'){
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

    public function delete($data)
    {        
        $blog_id = isset($data['blog_id']) ? $data['blog_id'] : '';

        if(!$blog_id)
        {
        return trans('blog.some_thing_wrong_when.delete');
        }

        $blog = $this->model->find($blog_id);
        if($blog)
        {
            $blog->delete();
            return true;
        }
        return trans('blog.blog_deleted_before');

    }  

    public function update($data)
    {
        $dataCreate = array(
            'title'         => isset($data['title']) ? $data['title'] : '',     
            'content'      => isset($data['content']) ? $data['content'] : '',
            'cover'    => isset($data['cover']) ? $data['cover'] : '',
            'publish_date'    => isset($data['publish_date']) ? $data['publish_date'] : '',
            'blog_id' => isset($data['blog_id']) ? $data['blog_id'] : '',
        );

        // TODO SOMETHING TO VALIDATE DATACREATE
        if($this->IsNullElementInArray($dataCreate) != null)
        {
            return $this->IsNullElementInArray($dataCreate);
        }

        if($data['cover'] !== 'undefined' || $data['cover'] !== 'image-default'){
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

        $blog = $this->model->find($dataCreate['blog_id']);

        if($blog)
        {
            $new_blog = $blog->update($dataCreate);
            if($new_blog) return $this->model->find($dataCreate['blog_id']);
            return false;
        }
        return false;
    }

    public function verify($data){
        $dataCreate = array(
            'blog_id' => isset($data['blog_id']) ? $data['blog_id'] : '',
            'is_verifited' => isset($data['is_verifited']) ? $data['is_verifited'] : '',
        );

        // TODO SOMETHING TO VALIDATE DATACREATE
        if($this->IsNullElementInArray($dataCreate) != null)
        {
            return $this->IsNullElementInArray($dataCreate);
        }

        $blog = $this->model->find($dataCreate['blog_id']);

        if($blog)
        {
            $new_blog = $blog->update($dataCreate);
            if($new_blog)
            return true;
            return trans('blog.something_wrong');
        }
        return trans('blog.cant_find_blog');
    }





}