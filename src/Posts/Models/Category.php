<?php

namespace Larapress\Posts\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'LP_posts_categories';

    protected $fillable = ['title', 'status', 'slug', 'description'];

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
