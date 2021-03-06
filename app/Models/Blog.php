<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $fillable = [
        'name',
        'title',
        'content',
        'is_verifited',
        'slug',
        'publish_date',
        'created_user_id',   
        'cover',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
