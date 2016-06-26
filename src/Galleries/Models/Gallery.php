<?php

namespace Larapress\Galleries\Models;

use Larapress\Admin\Traits\ImageAttachmentTrait;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use ImageAttachmentTrait;

    protected $imageAttachmentNames = 'gallery-image'; //part of imageAttachmentTrait requirement

    protected $table = 'LP_galleries';

    protected $guarded = ['id'];
}
