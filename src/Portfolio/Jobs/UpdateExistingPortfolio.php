<?php

namespace Larapress\Portfolio\Jobs;

use Larapress\Portfolio\Models\Portfolio;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\Request;

class UpdateExistingPortfolio extends Job implements ShouldQueue
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
        $project = Portfolio::findOrFail($this->id);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'status' => $request->status,
            'website' => $request->website,
            'launched_date' => $request->launched_date,
            'cover_image' => $request->cover_image,
        ]);

        \Session::flash('success', 'Your project has been updated successfully');
    }
}
