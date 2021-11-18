<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends AdminController
{
    protected $modelBlog;
    
    public function __construct(   
        Blog $blog
    )
    {
        $this->modelBlog = $blog;
    }

    public function index()
    {
        return view('admin.blog.index');
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        // validate
        $check = $this->validateRequestBlog('create',$data);
        if( $check !== true)
        {
            return $check;  
        }

// code true here 
        try {
            $new_blog = $this->BlogRepository->create($data);
            if($new_blog)
            {
                return $this->responseSuccess(trans('user.add_success'),[
                    'new_row' => view('admin.user.user-collumn',[
                        'blog' => $new_blog,
                    ])->render(),  
                ]);
                
            }
            return false;
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->responseError(400,trans('user.fail.add'));
        }

    }

    
    public function show($id)
    {
        $blog = $this->modelBlog->findOrFail($id);

        return view('admin.blog.show',[
            'blog' => $blog,
        ]);
    }

    
    public function edit($id)
    {
        $blog = $this->modelBlog->findOrFail($id);

        return view('admin.blog.edit',[
            'blog' => $blog,
        ]);
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        $blog = $this->modelBlog->findOrFail($id);
        
        try {
            $blog->delete();

            return redirect()
                ->route('admin.blog.index')
                ->with('msg','Delete success!');

        } catch (\Exception $e) {
            
            \Log::error($e);

            return redirect()
                ->route('admin.blog.index')
                ->with('error','Delete failed. Please try again later!');
        }
    }
}
