--php

namespace {Vendor}\{Package}\{Models}\Jobs;

use {Vendor}\{Package}\{Models}\Models\{Model};
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\Request;

class UpdateExistingPage extends Job implements ShouldQueue
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
        ${model} = {Model}::findOrFail($this->id);

        $page->update([
            'title' => $request->get('title'),
        ]);

        \Session::flash('success', 'Your {model} has been updated successfully');
    }
}
