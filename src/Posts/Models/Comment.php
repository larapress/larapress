<?php

namespace Larapress\Posts\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'LP_posts_comments';

    protected $fillable = ['body', 'status', 'user_id', 'name_given', 'email_given', 'ip_address'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }
}
