<?php

namespace App\Repositories\Client;

use App\Events\Blog\RecordBlog;
use App\Models\Blog;
use Illuminate\Support\Facades\Cache;
use App\Events\Story\StoryCreate;
use Illuminate\Support\Facades\Auth;
class BlogRepository
{
    public function __construct()
    {

    }

    public function put_all()
    {
        if(!Cache::has('blog-ádfadfa')) {
            $arr_blog = [];
            $blogs = Blog::where('is_verifited','1')
            ->with('user')
            ->get();
            foreach ($blogs as $key => $blog) {
                if($blog->slug !== null) {
                    $cacheKey = 'blog-'.$blog->slug;
                    Cache::put($cacheKey, $blog->toArray(), 600000);
                }

            }

        }

    }

    public function put_blog_single($key = 'blog-single', $value)
    {
        cache($key, $value,  now()->addMinutes(10000));
    }

    public function get_blog_single($slug)
    {
        $this->put_all();
        $blog = Cache::get("blog-$slug");
        return $blog;
    }

    public function remove_all()
    {
        Cache::flush();
    }

    public function retrieve_all()
    {
        $blogs = Blog::where('is_verifited','1')
        ->with('user')
        ->get();
        $arr_blog = [];
        foreach ($blogs as $key => $blog) {
            if($blog->slug !== null) {
                $cacheKey = 'blog-'.$blog->slug;
                $arr_blog[$key] = Cache::pull($cacheKey);
            }
        }
        return $arr_blog;
    }


}
