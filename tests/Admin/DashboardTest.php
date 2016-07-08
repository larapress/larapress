<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;

    protected $administrator;

    protected $administratorFactory;


    public function setUp()
    {
        parent::setUp();

        $this->user = factory(\App\User::class)->create();

        $this->administratorFactory = new \Larapress\Admin\Database\Factories\AdministratorFactory(Faker\Factory::create(), \Carbon\Carbon::create());

        $this->administrator = $this->administratorFactory->administrator($this->user->id)->save();

    }

    /**
     * Dashboard Test
     *
     * @return void
     */
    public function test_to_see_dashboard_authentication()
    {
        $this->visit('/dashboard')
            ->seePageIs('login');

        $this->actingAs($this->user)
            ->visit('/dashboard')
            ->see('dashboard');
    }
}
