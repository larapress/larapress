<?php
namespace Larapress\Pages\Database\Seeds;

use Illuminate\Database\Seeder;
use Larapress\Pages\Database\Factories\Factory;

class PagesTableSeeder extends Seeder
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
        $this->factory->page()->save();
    }
}
