<?php

namespace Larapress\Portfolio\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'LP_portfolio';

    protected $fillable = ['title', 'content', 'status'];
}
