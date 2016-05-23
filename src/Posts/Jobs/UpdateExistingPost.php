<?php

namespace Larapress\Posts\Jobs;

use Larapress\Posts\Models\Post;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\Request;

class UpdateExistingPost extends Job implements ShouldQueue
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
       $post = Post::findOrFail($this->id);

        $post->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'body' => $request->get('body')
        ]);

        \Session::flash('success', 'Your post has been saved successfully');
    }
}
