<?php

namespace Larapress\Galleries\Jobs;

use Larapress\Galleries\Models\Gallery;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\Request;

class UpdateExistingGallery extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
     }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $gallery = Gallery::findOrFail($this->id);

        $gallery->update([
            'title' => $request->get('title'),
        ]);

        \Session::flash('success', 'Your gallery has been saved successfully');
    }
}
