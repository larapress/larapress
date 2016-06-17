<?php

namespace Larapress\Posts\Models;

use Illuminate\Database\Eloquent\Model;
use Larapress\Admin\Traits\ImageAttachmentTrait;

class Post extends Model
{
    use ImageAttachmentTrait;

    protected $imageAttachmentNames = 'post-image'; //part of imageAttachmentTrait requirement

    protected $table = 'LP_posts';

    protected $fillable = ['title', 'body', 'status', 'slug', 'description'];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
