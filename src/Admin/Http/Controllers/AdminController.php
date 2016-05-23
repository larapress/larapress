<?php

namespace Larapress\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class AdminController extends Controller
{
    public function dashboard(){
        return view('larapress::dashboard');
    }
}
