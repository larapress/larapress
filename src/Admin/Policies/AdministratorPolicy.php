<?php
namespace Larapress\Admin\Policies;

use App\User;

class AdministratorPolicy
{
    public function create(User $user, $model)
    {
        return true;
    }
}