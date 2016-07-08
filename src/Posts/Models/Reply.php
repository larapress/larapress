<?php

namespace Larapress\Posts\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'LP_posts_replies';

    protected $fillable = ['body', 'status', 'user_id', 'name_given', 'email_given', 'ip_address'];

    public function comment(){
        $this->belongsTo(Comment::class);
    }
}
