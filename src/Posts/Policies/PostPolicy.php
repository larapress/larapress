<?php
namespace Larapress\Posts\Policies;


use Larapress\Admin\Policies\LarapressPolicy;

class PostPolicy extends LarapressPolicy
{
    protected  $configFile = 'larapress.authorization.posts';

}