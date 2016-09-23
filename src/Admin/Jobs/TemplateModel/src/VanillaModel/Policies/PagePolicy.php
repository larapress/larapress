--php
namespace {Vendor}\{Package}\{Models}\Policies;


use Larapress\Admin\Policies\LarapressPolicy;

class {Model}Policy extends LarapressPolicy
{
    //this is the config file that LarapressPolicy will check
    protected  $configFile = '{package}.authorization.{models}';

}