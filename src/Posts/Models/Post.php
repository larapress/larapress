<?php

namespace Larapress\Posts\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'LP_posts';

    protected $fillable = ['title', 'body', 'status', 'slug', 'description'];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
