<?php
namespace Larapress\Admin\Database\Factories;

use Larapress\Admin\Models\Administrator;

class AdministratorFactory extends ParentFactory
{

     public function administrator($user_id = null)
    {
        $user_id = ($user_id ) ? $user_id : rand(1,10);

        return new Administrator([
            'created_at' => $this->faker->time($this->time->now()),
            'updated_at' => $this->faker->time($this->time->now()),
            'user_id' => $user_id,
            'status' =>  'active',
            'role' => 'admin'
        ]);
    }
}

