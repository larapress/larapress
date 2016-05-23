<?php
namespace Larapress\Admin\Database\Seeds;

use Illuminate\Database\Seeder;
use Larapress\Admin\Database\Factories\Factory;

class AdministratorsTableSeeder extends Seeder
{
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->factory->administrators()->save();
    }
}
