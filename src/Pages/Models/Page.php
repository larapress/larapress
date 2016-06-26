<?php

namespace Larapress\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'LP_pages';

    protected $fillable = ['title', 'body', 'status', 'slug'];
}
