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
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::check()) {
            return redirect()->route('larapress.login');
        }

        try {
            $administrator = Administrator::where('user_id', \Auth::user()->id)
                ->where('status', 'active')
                ->firstOrFail();
        } catch (\Exception $e) {
            \Auth::logout();

            return redirect()->route('larapress.login');
        }

        return $next($request);
    }
}
