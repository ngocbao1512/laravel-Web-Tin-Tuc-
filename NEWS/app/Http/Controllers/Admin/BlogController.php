<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
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
       // dd("ok");
        //$blogs = $this->modelBlog->paginate(config('blog.paginate8'));
        return view('admin.blog.index');
    }

    
    public function create()
    {
        return view('admin.layouts.blog.create');
    }

    
    public function store(Request $request)
    {
        dd('ok');
        $data_blog  = $request->only([
            'title',
            'content',
        ]);

        $data_blog['user_id'] = auth()->id();

        // save image 
        $file = $request->file('image');
        if ($file) {
            // $file->hashName = encodeImage($file);
             $image_name = encodeImage($file);
             $file->move('storage/images',$image_name);
             $data_image['name'] = $image_name;
             $new_image = $this->modelImage->create($data_image);
         }

        try {
            // save blog
            $data_blog['image_id'] = $new_image->id;

            $this->modelBlog->create($data_blog);

            return redirect()
                ->route('admin.blogs.index')
                ->with('msg','create success!');

        } catch (\Exception $e) {
            
            \Log::error($e);

            return redirect()
                ->route('admin.blogs.index')
                ->with('error','create failed. Please try again later!');
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
