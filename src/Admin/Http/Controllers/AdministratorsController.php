<?php

namespace Larapress\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Larapress\Admin\Models\Administrator;

class AdministratorsController extends Controller
{
    public function index(){
        $administrators = Administrator::all();

        return view('larapress::administrators.index')->with('administrators', $administrators);
   }

    public function create(){
        return view('larapress::administrators.create');
    }

    public function store(){
        $this->validate($request, config('larapress.administrators.create_form'));

        $this->dispatch(new SaveNewAdministrator($request));

        return redirect()->route('larapress.administrators.index');
    }
}
