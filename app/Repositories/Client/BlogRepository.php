<?php

namespace App\Repositories\Client;

use App\Models\Blog;
use Illuminate\Support\Facades\Cache;
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
        return Cache::pull("blog-$slug");
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
    } // n(n+1) : page 1 : 0 - 8 , page 2 : 9 - 16 , page 3 : 17 - 25 
}
