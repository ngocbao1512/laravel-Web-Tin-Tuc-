<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Repositories\Blog\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Blog;

class BlogController extends AdminController
{
    protected $modelBlog;
    protected $modelUser;
    protected $blogRepository;
    
    public function __construct(   
        Blog $blog
    )
    {
        $this->modelBlog = $blog;
        $this->blogRepository = new BlogRepository;
    }

    public function index()
    {
        $all_blog = $this->modelBlog->get();

        return view('admin.blog.index',[
            'blogs' => $all_blog,
        ]);
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        $data['author_id'] = auth()->id();
        // validate
        $check = $this->validateRequestBlog('create',$data);
        if( $check !== true)
        {
            return $check;  
        }

        try {
            $new_blog = $this->blogRepository->create($data);
            if($new_blog)
            {
                return $this->responseSuccess(trans('blog.add_success'),[
                    'new_row' => view('admin.blog.blog-collumn',[
                        'blog' => $new_blog,
                    ])->render(),  
                ]);
            }
            return false;
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError(400,trans('blog.fail.add'));
        }

    }

    public function show(Request $request)
    {
        $data = $request->all();
        if(!isset($data['blog_id'])){
            return $this->responseError(500,trans('blog.invalid_data.blog'));
        }

        try {       
            $blog = $this->blogRepository->find($data['blog_id']);
            if(is_null($blog)){
                return $this->responseError(404,trans('blog.no_data_blog'));
            }

            return $this->responseSuccess(trans('blog.find_success'),[
                'blog_form' => view('admin.blog.blog-form',[
                    'blog' => $blog,
                ])->render(),  
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError($e);
        }
        
    }

    
    public function edit($id)
    {
        $blog = $this->modelBlog->findOrFail($id);

        return view('admin.blog.edit',[
            'blog' => $blog,
        ]);
    }

    
    public function update(Request $request)
    {
        $data = $request->all();

        // validate data 
        if($this->validateRequestBlog('update',$data) !== true)
        {
            return $this->validateRequestBlog('update',$data);
        }

        return $this->blogRepository->update($data);
        
        try {
            $new_blog = $this->blogRepository->update($data);
            //return $new_blog;
            if($new_blog == false)
            {
                return false;
            }
            return $this->responseSuccess(trans('blog.update_success'),[
                'new_row' => view('admin.blog.blog-collumn',[
                    'blog' => $new_blog,
                ])->render(),  
            ]);
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError($e);
        }
        
    }

    
    public function destroy(Request $request)
    {
        
        $data = $request->all();
        if(!$data['blog_id'])
        return $this->responError(404,trans('blog.some_thing_wrong_when.delete'));

        try {
            $check = $this->blogRepository->delete($data);
            if( $check !== true)
            {
                return $this->responseError(404,$check);
            }
                return $this->responseSuccess(trans('blog.delete_success'));
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError($e);
        }
    }

    public function verify(Request $request)
    {
        $data = $request->all();


        // validate data 
        if(!isset($data['blog_id']) || !isset($data['is_verifited']))
        {
           return $this->responseError(404,trans('blog.something_wrong'));
        }


        try {
            $check = $this->blogRepository->verify($data);
            if($check == true)
            {
                return $this->responseSuccess(trans('blog.verify.success'));
            }
            return false;
            
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError(400,$e);
        }
    }
}


