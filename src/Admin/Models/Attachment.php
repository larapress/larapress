<?php

namespace Larapress\Admin\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $guarded = ['id'];

    protected $table = 'LP_attachments';
}
