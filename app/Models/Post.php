<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'slug', 'description', 'image_path', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return[
            'slug' =>[
                'source' => 'title'
            ]
        ];
    }


    //comment
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    //Like
    public function likedUsers()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
}