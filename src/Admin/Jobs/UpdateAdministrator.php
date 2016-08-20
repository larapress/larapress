<?php

namespace Larapress\Admin\Jobs;

use Illuminate\Foundation\Bus\DispatchesJobs;
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
    use InteractsWithQueue, SerializesModels, DispatchesJobs;


    protected $id;

    protected $input;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $input)
    {
        $this->id = $id;

        $this->input = $input;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $administrator = Administrator::findOrFail($this->id);

        $administrator->update([
            'role' => $this->input["role"],
            'status' => $this->input["status"]
        ]);

        $user = User::findOrFail($administrator->user_id);

        $user->update([
            'name' => $this->input["name"],
            'email' => $this->input["email"]
        ]);

        \Session::flash('success', 'Administrator has been updated.');

        event(new AdministratorWasUpdated($administrator));
    }
}
