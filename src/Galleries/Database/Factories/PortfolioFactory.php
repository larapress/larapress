<?php
namespace Larapress\Portfolio\Database\Factories;

use Larapress\Admin\Database\Factories\ParentFactory;
use Larapress\Portfolio\Models\Portfolio;

class PortfolioFactory extends ParentFactory{

    public function page()
    {
        $title = $this->faker->sentence(6);

        return new Portfolio([
            'title' => $title,
            'slug' => str_slug($title),
            'created_at' => $this->faker->time($this->time->now()),
            'updated_at' => $this->faker->time($this->time->now()),
            'description' => $this->faker->sentence(2),
            'body' => $this->faker->paragraph(10),
            'status' => $this->faker->randomElement(['draft', 'published', 'trashed'])
        ]);
    }
}

