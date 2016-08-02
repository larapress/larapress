<?php

namespace Larapress\Portfolio\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'LP_portfolio';

    protected $fillable = ['title', 'body', 'status', 'slug', 'description', 'website', 'launched_date', 'cover_image'];
}
