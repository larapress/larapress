<?php

namespace Larapress\Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Larapress\Admin\Models\Administrator;

class LarapressRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $file)
    {
        //if there is no config key, then it will be assumed to allow user through
        try{
            $allowedRoles = (config($file . '.'. str_replace('.', '_', $request->route()->getName())));
        }catch(\Exception $e){
            return $next($request);
        }

        if (in_array(\Auth::user()->administrator->role, $allowedRoles) || \Auth::user()->administrator->role == 'super') {
            return $next($request);
        }

        return redirect()->route('larapress.deny');
    }
}
