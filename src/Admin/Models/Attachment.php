<?php

namespace Larapress\Admin\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $guarded = ['id'];

    protected $table = 'LP_attachments';

    /**
     * Returns an array of objects in a format suitable for vue to populate attachments
     */
    static public function getByModel($model, $model_id, $context)
    {
        $attachments = Attachment::where('model_id', $model_id)
            ->where('context', $context)
            ->where('model', $model)
            ->orderBy('priority', 'asc')
            ->get();

        $result = [];

        foreach ($attachments as $attachment) {
            $details = new \stdClass();
            $details->id = $attachment->id;
            $details->url = $attachment->url;
            $details->alt = $attachment->alt;
            $details->caption = $attachment->caption;
            $details->priority = $attachment->priority;

            $result[] = $details;
        }

        return $result;
    }
}
