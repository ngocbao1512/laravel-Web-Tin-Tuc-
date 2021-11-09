<?php
namespace App\Repositories\Blog;
use App\Repositories\BaseRepository;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Blog::class;
    }
}