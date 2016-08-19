<?php

namespace Larapress\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view(config('larapress.settings.dashboard_view'));
    }

    public function login()
    {
        if (\Auth::check()) return redirect()->route('larapress.dashboard');

        return view('larapress::login');
    }

    public function auth(Request $request)
    {
        if (\Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('larapress.dashboard');
        }

        \Session::flash('error', 'Sorry, login failed');

        return view('larapress::login');
    }

    public function logout()
    {
        \Auth::logout();

        return view('larapress::login');
    }

    public function deny(){
        return view('larapress::deny');
    }
}
