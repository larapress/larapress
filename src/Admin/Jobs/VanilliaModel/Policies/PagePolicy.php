<?php
namespace Larapress\Pages\Policies;


use Larapress\Admin\Policies\LarapressPolicy;

class PagePolicy extends LarapressPolicy
{
    //this is the config file that LarapressPolicy will check
    protected  $configFile = 'larapress.authorization.pages';

}