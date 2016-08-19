<?php

namespace Larapress\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Larapress\Admin\Jobs\UpdateAdministrator;
use Larapress\Admin\Models\Administrator;
use Larapress\Admin\Jobs\SaveNewAdministrator;

class AdministratorsController extends Controller
{
    public function index(){
        $administrators = Administrator::where('status', '!=', 'trashed')->paginate(30);

        return view('larapress::administrators.index')->with('administrators', $administrators);
   }

    public function create(){
        if (\Gate::denies('create', Administrator::class)) {
            abort(403);
        }

        return view('larapress::administrators.create');
    }

    public function store(Request $request){
        $this->validate($request, config('larapress.administrators.create_form'));

        $this->dispatch(new SaveNewAdministrator($request));

        return redirect()->route('larapress.administrators.index');
    }

    public function edit($id){
        $administrator = Administrator::findOrFail($id);

        return view('larapress::administrators.edit')->with('administrator', $administrator);
    }

    public function update(Request $request, $id){
        $this->dispatch(new UpdateAdministrator($id));

        return redirect()->route('larapress.administrators.index');
    }
}