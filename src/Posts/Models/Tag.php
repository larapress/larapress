<?php

namespace Larapress\Posts\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'LP_post_tags';

    protected $fillable = ['title', 'body', 'status'];


}
