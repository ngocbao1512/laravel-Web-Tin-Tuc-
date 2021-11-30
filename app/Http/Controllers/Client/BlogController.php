<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Repositories\Client\BlogRepository;
use App\Models\Blog;
use App\Models\Customer;
use App\Models\Comment;

class BlogController extends ClientController
{
    protected $blogRepository;
    protected $modelBlog;
    protected $modelCustomer;
    protected $modelComment;

    public function __construct(
        Blog $blog,
        Customer $customer,
        Comment $comment
        )
    {
        $this->modelBlog = $blog;
        $this->blogRepository = new BlogRepository;
        $this->modelCustomer = $customer;
        $this->modelComment = $comment;
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

    public function comment (Request $request) 
    {
        $data = $request->all();
        $this->validate_comment($data);
        // check email constain trong session ? create customer -> luu vao session : continue 
        if(session('email') == null)
        {
            // save email user_name vaof database 
            $data_customer = $request->only(['email','user_name']);
            $new_customer = $this->modelCustomer->create($data_customer);
            session('email',$data_customer['email']);
            session('user_name',$data_customer['user_name']);
            session('customer_id',$new_customer->id); 
            $data['customer_id'] = $new_customer->id;
        }

        // xu ly comment 
        // check blog_id 
        if(is_null($this->modelBlog->find($data['blog_id']) ) )
        {
            return responseError(500,'some thing went wrong. please try again later!!!');
        };

        // tao comment 
        $new_comment =  $this->modelComment->create($data);

        $comments = $this->modelComment->where('blog_id',$data['blog_id'])->get();

        return $this->responseSuccess(trans('blog.comment_success'),[
            'comments' => view('client.single-post.comments',[
                'comments' => $comments,
            ])->render(),
        ]);
    }

    public function loadcomment(Request $request)
    {
        $comments = $this->modelComment->where('blog_id',$request->all())->get();

        return $this->responseSuccess(trans('blog.comment_success'),[
            'comments' => view('client.single-post.comments',[
                'comments' => $comments,
            ])->render(),
        ]);

    }

}
