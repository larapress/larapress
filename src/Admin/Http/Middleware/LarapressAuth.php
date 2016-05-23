<?php

namespace Larapress\Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Larapress\Admin\Models\Administrator;

class LarapressAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        return $next($request);

        if (!Auth::check()) {
            return redirect()->guest('login');
        }

        try {
            Administrator::where('user_id', \Auth::user()->id)
                ->where('status', 'active')
                ->firstOrFail();

        } catch (\Exception $e) {
            return redirect()->guest('login');
        }

        return $next($request);
    }
}
