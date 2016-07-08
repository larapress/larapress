<?php
namespace Larapress\Admin\Database\Factories;

use Carbon\Carbon;
use Faker;

class ParentFactory
{

    public function __construct(Faker\Generator $faker, Carbon $time)
    {
        $this->faker = $faker;
        $this->time = $time;
    }
}

