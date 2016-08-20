<?php

namespace Larapress\Admin\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Larapress\Admin\Jobs\SaveNewAdministrator;

class CreateAdministrator extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larapress:administrator {name} {email} {password} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an administrator';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->dispatch(new SaveNewAdministrator([
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => $this->argument('password'),
            'role' => $this->argument('role'),
            'active' => 'true'
        ]));

        $this->info('Administrator has been created');
    }
}
