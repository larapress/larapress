<?php

namespace Larapress\Galleries\Jobs;

use Larapress\Galleries\Models\Gallery;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\Request;

class SaveNewGallery extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $gallery = Gallery::create([
            'title' => $request->get('title'),
            'slug' => str_slug($request->get('slug')),
        ]);

        $gallery->SaveImageAttachments($request);

        \Session::flash('success', 'Your gallery has been saved.');
    }
}
