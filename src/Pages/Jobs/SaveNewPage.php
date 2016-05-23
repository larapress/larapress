<?php

namespace Larapress\Pages\Jobs;

use Larapress\Pages\Models\Page;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\Request;

class SaveNewPage extends Job implements ShouldQueue
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
        $page = Page::create([
            'title' => $request->title,
            'description' => $request->get('description'),
            'slug' => str_slug($request->slug),
            'body' => $request->body,
        ]);

        \Session::flash('success', 'Your page has been saved.');

        event(new \Larapress\Pages\Events\PageWasSaved($page));
    }
}
