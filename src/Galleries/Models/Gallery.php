<?php

namespace Larapress\Galleries\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'LP_galleries';

    protected $guarded = ['id'];
}
