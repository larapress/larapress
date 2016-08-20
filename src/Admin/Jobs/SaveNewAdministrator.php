<?php

namespace Larapress\Admin\Jobs;

use Larapress\Admin\Events\AdministratorWasCreated;
use Larapress\Admin\Events\test;
use Larapress\Admin\Models\Administrator;
use App\Jobs\Job;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\Request;

class SaveNewAdministrator extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $input;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::create([
            'name' => $this->input["name"],
            'email' => $this->input["email"],
            'password' => \Hash::make($this->input["password"])
        ]);

        $administrator = Administrator::create([
            'user_id' => $user->id,
            'role' => $this->input["role"],
            'status' => isset($this->input["status"]) ? $this->input["status"] : true
        ]);

        \Session::flash('success', 'Administrator has been created.');

        event(new AdministratorWasCreated($administrator));
    }
}
