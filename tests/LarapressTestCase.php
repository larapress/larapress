<?php

class LarapressTestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    protected $user;

    protected $administrator;

    protected $administratorFactory;

    public function __construct()
    {
        parent::setUp();

        $this->user = factory(\App\User::class)->create();

        $this->administratorFactory = new \Larapress\Admin\Database\Factories\AdministratorFactory(Faker\Factory::create(), \Carbon\Carbon::create());

        $this->administrator = $this->administratorFactory->administrator($this->user->id)->save();
    }


    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../../../../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
