<?php

namespace Larapress\Admin\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Larapress\Admin\Jobs\CreateModel as CreateModelJob;

class CreateModel extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larapress:createModel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an new model boilerplate';

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
        $input = [];

        $input["root"] = $this->anticipate('What is your root directory?', ['vendor']);

        $input["vendor"] = $this->ask('What is your vendor name?');

        $input["package"] = $this->ask('What is your package name?');

        $input["model"] = $this->ask('What is your singular model name?');

        $input["models"] = $this->ask('What is your plural model name?');

        $this->dispatch(new CreateModelJob($input));

        $this->info('New model has been created');
    }
}
