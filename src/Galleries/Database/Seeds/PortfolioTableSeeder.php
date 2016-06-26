<?php
namespace Larapress\Portfolio\Database\Seeds;

use Illuminate\Database\Seeder;
use Larapress\Portfolio\Database\Factories\PortfolioFactory;

class PortfolioTableSeeder extends Seeder
{
    public function __construct(PortfolioFactory $factory)
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
