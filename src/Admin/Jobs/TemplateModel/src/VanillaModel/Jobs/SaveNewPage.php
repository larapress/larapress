--php

namespace {Vendor}\{Package}\{Models}\\Jobs;

use {Vendor}\{Package}\{Models}\Models\{Model};
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
        ${model} = {Model}::create([
            'title' => $request->get('title'),
            'slug' => str_slug($request->get('slug')),
        ]);

        \Session::flash('success', 'Your {model} has been saved.');

        event(new \{vendor}\{package}\Events\{Model}WasSaved(${model}));
    }
}
