<?php
namespace Larapress\Posts\Database\Factories;

use Larapress\Admin\Database\Factories\ParentFactory;
use Larapress\Posts\Models\Category;
use Larapress\Posts\Models\Comment;
use Larapress\Posts\Models\Post;
use Larapress\Posts\Models\Reply;

class PostFactory extends ParentFactory{

    public function post($status = null)
    {
        $title = $this->faker->sentence(6);

        if(!$status) $status = $this->faker->randomElement(['draft', 'published']);

        return new Post([
            'title' => $title,
            'slug' => str_slug($title),
            'created_at' => $this->faker->time($this->time->now()),
            'updated_at' => $this->faker->time($this->time->now()),
            'description' => $this->faker->sentence(2),
            'body' => $this->faker->paragraph(10),
            'status' => $status
        ]);
    }

    public function category($status = null){
        $title = $this->faker->sentence(6);

        if(!$status) $status = $this->faker->randomElement(['draft', 'published']);

        return new Category([
            'title' => $title,
            'slug' => str_slug($title),
            'created_at' => $this->faker->time($this->time->now()),
            'updated_at' => $this->faker->time($this->time->now()),
            'description' => $this->faker->sentence(3),
            'status' => $status
        ]);
    }

    public function comment($status = null){
          if(!$status) $status = $this->faker->randomElement(['draft', 'published', 'subbmitted', 'flagged']);

        return new Comment([
            'created_at' => $this->faker->time($this->time->now()),
            'updated_at' => $this->faker->time($this->time->now()),
            'body' => $this->faker->sentence(3),
            'email_given' => $this->faker->safeEmail(),
            'name_given' => $this->faker->name(),
            'ip_address' => $this->faker->ipv4(),
            'status' => $status
        ]);
    }

    public function reply($status = null){
        if(!$status) $status = $this->faker->randomElement(['draft', 'published', 'subbmitted', 'flagged']);

        return new Reply([
            'created_at' => $this->faker->time($this->time->now()),
            'updated_at' => $this->faker->time($this->time->now()),
            'body' => $this->faker->sentence(3),
            'email_given' => $this->faker->safeEmail(),
            'name_given' => $this->faker->name(),
            'ip_address' => $this->faker->ipv4(),
            'status' => $status
        ]);
    }
}

