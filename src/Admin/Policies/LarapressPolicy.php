<?php
namespace Larapress\Admin\Policies;

use App\User;
use Illuminate\Http\Request;

abstract class LarapressPolicy
{
    protected $request;

    protected $configFile; //this must be set by the instance class

    public function __construct(Request $request){
        $this->request = $request;
    }

    /**
     * Universal before method run before all routes in policy
     * @param User $user
     * @param $model
     */
    public function before(User $user, $capability){
        return $this->checkRouteAgainstConfig($this->configFile, $user->administrator->role, $capability);
    }

    /**
     * Checks to see if route is allowed in a given role
     * @param $file
     */
    protected function checkRouteAgainstConfig($file, $role, $capability){
        $allowedRoles = $this->getArrayOfRolesFromConfig($file, $capability);

        return in_array($role, $allowedRoles);
    }

    /**
     * Retreives array of roles from config file, based on capability.
     * @param $file
     * @param $route
     * @return array
     */
    protected function getArrayOfRolesFromConfig($file, $capability){
        $roles =  config($file . '.'. $capability);

        return ($roles != null) ? $roles : [];
    }


    /**
     * Default create policy method
     * @param User $user
     * @param $model
     * @return bool
     */
    public function create(User $user, $model){
        return true;
    }

    /**
     * Default store policy method
     * @param User $user
     * @param $model
     * @return bool
     */
    public function store(User $user, $model){
        return true;
    }

    /**
     * Default create policy method
     * @param User $user
     * @param $model
     * @return bool
     */
    public function edit(User $user, $model){
        return true;
    }

    /**
     * Default update policy method
     * @param User $user
     * @param $model
     * @return bool
     */
    public function update(User $user, $model){
        return true;
    }

    /**
     * Default destroy policy method
     * @param User $user
     * @param $model
     * @return bool
     */
    public function destroy(User $user, $model){
        return true;
    }

}