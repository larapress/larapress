<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PagesTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;

    protected $administrator;

    protected $administratorFactory;

    protected $pageFactory;

    protected $page;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(\App\User::class)->create();

        $this->administratorFactory = new \Larapress\Admin\Database\Factories\AdministratorFactory(Faker\Factory::create(), \Carbon\Carbon::create());

        $this->administrator = $this->administratorFactory->administrator($this->user->id)->save();

        $this->pageFactory = new \Larapress\Pages\Database\Factories\PageFactory(Faker\Factory::create(), \Carbon\Carbon::create());

        $this->page = $this->pageFactory->page()->create();

        $this->page->save();
    }

    /**
     * General check to test main routes are covered by authentication,
     * as we use resources that are wrapped by middleware, we just test index.
     *
     * @return void
     */
    public function test_to_see_pages_authentication()
    {
        $this->visit('/larapress/pages')
            ->seePageIs('login');

        $this->actingAs($this->user)
            ->visit('/larapress/pages')
            ->see('Your web applications pages');
    }


    public function test_to_see_user_can_create_page()
    {
        $this->actingAs($this->user)
            ->visit('/larapress/pages/create')
            ->type('Test Page', 'title')
            ->type('Test Page', 'slug')
            ->type('Some contents to test', 'body')
            ->press('Save')
            ->seePageIs('/larapress/pages')
            ->seeInDatabase('LP_pages', ['title' => 'Test Page'])
            ->see('Your page has been saved.');
    }

    public function test_to_see_user_can_update_page()
    {
        $this->actingAs($this->user)
            ->visit('/larapress/pages/' . $this->page->id . '/edit')
            ->see('Edit Page:')
            ->type('Test Page Edited', 'title')
            ->press('Save')
            ->seePageIs('/larapress/pages')
            ->see('Your page has been saved successfully');
    }

    public function test_to_see_user_can_search_for_pages()
    {
        $this->actingAs($this->user)
            ->visit('/larapress/pages/')
            ->type(substr($this->page->title, 0,-4), 'term')
            ->press('Search')
            ->seePageIs('/larapress/pages/search')
            ->see($this->page->title);
    }
}
