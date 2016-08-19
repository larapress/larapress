<?php

namespace Larapress\Admin\Jobs;

use Larapress\Admin\Events\AdministratorWasUpdated;
use Larapress\Admin\Events\test;
use Larapress\Admin\Models\Administrator;
use App\Jobs\Job;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\Request;

class UpdateAdministrator extends Job implements ShouldQueue
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
        $administrator = Administrator::findOrFail($this->id);

        $administrator->update([
            'role' => $request->role,
            'status' => $request->status
        ]);

        $user = User::findOrFail($administrator->user_id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        \Session::flash('success', 'Administrator has been updated.');

        event(new AdministratorWasUpdated($administrator));
    }
}
