<?php
namespace Larapress\Admin\Policies;

use App\User;

class AdministratorPolicy extends LarapressPolicy
{
    protected  $configFile = 'larapress.authorization.administrators';
}