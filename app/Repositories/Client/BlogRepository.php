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
        cache('blogs',  Blog::get()->toArray() , 600000);

        return Cache::get('blogs');


    }

    public function put_blog_single($key = 'blog-single', $value)
    {
        cache($key, $value,  now()->addMinutes(10000));
    }

    public function get_blog_single($key = 'blog-single')
    {
        return cache('blog-single');
    }

    public function remove_all()
    {
        Cache::flush();
    }

    public function retrieve_all()
    {
        return cache('blogs');
    }
}
