<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Repositories\Client\BlogRepository;
use App\Models\Blog;

class BlogController extends Controller
{
    protected $blogRepository;
    protected $modelBlog;

    public function __construct(Blog $blog)
    {
        $this->modelBlog = $blog;
        $this->blogRepository = new BlogRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->blogRepository->put_all();

        return view('client.home-client.home',[
            'blogs' => $this->blogRepository->retrieve_all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    { 
        // tìm blog có slug trong cache và show ra 
        return view('client.single-post.post',[
            'blog' => $this->blogRepository->get_blog_single($slug),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function find(Request $request)
    {
       $query = $request->data;
       
       $posts = $this->modelBlog
       ->where('slug', 'LIKE', "%{$query}%")
       ->get();

       if(isset($posts[0])) {
           return $this->responseSuccess(trans('blog.find_success'),[
               'blogs' => view('client.home-client.posts',[
                   'blogs' => $posts,
               ])->render(),  
           ]);
       } 

       try {
            $posts = $this->modelBlog
            ->where('slug', 'LIKE', "%{$query}%")
            ->get();

            if(isset($posts[0])) {
                return $this->responseSuccess(trans('blog.find_success'),[
                    'blogs' => view('client.home-client.posts',[
                        'blogs' => $posts,
                    ])->render(),  
                ]);
            } 
            return $this->responseError(404,trans('blog.find_null'));
 
       } catch (\Throwable $th) {
           return $this->responseError(500, trans('blog.find_error'));
       }
       
      
    }
}
