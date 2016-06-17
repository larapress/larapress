<?php

namespace Larapress\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Larapress\Admin\Models\Attachment;

class AttachmentController extends Controller
{
    public function getByModel(Request $request)
    {
        $attachments = Attachment::where('model_id', $request->get('model_id'))->get();

        dd($attachments);
    }
}
