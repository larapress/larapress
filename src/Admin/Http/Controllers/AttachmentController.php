<?php

namespace Larapress\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Larapress\Admin\Models\Attachment;

class AttachmentController extends Controller
{
    /**
     * Return the json to populate the attachment list for a context
     */
    public function getByModel(Request $request)
    {
        $attachments = Attachment::getByModel($request->get('model'), $request->get('model_id'), $request->get('context'));

        return response()->json($attachments);
    }
}
