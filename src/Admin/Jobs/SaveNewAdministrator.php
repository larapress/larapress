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
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password)

        ]);

        $administrator = Administrator::create([
            'user_id' => $user->id,
            'role' => 'admin',
            'status' => 'active'
        ]);

        \Session::flash('success', 'Administrator has been created.');

        event(new AdministratorWasCreated($administrator));
    }
}
