<?php

namespace Larapress\Portfolio\Jobs;

use Larapress\Portfolio\Models\Portfolio;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\Request;

class SaveNewPortfolio extends Job implements ShouldQueue
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
        $project = Portfolio::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => str_slug($request->slug),
            'body' => $request->body,
            'status' => $request->status,
            'website' => $request->website,
            'launched_date' => $request->launched_date,
            'cover_image' => $request->cover_image,
        ]);

        \Session::flash('success', 'Your project has been saved.');

        event(new \Larapress\Portfolio\Events\PortfolioWasSaved($project));
    }
}
