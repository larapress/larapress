--php

namespace {Vendor}\{Package}\{Models}\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use {Vendor}\{Package}\{Models}\Jobs\SaveNew{Model};
use {Vendor}\{Package}\{Models}\Jobs\UpdateExisting{Model};
use {Vendor}\{Package}\{Models}\Models\{Model};

class {Models}Controller extends Controller
{
    /**
     * Index page for admin screen
     * @return $this
     */
    public function index()
    {
        $this->authorize('index', {Model}::class);

        ${models} = {Model}::where('status', '!=', 'trashed')->paginate(30);

        return view('{package}::{models}.index')->with('{models}', ${models});
    }

    public function search(Request $request)
    {
        $this->authorize('search', {Model}::class);

        ${models} = {Model}::where('status', '!=', 'trashed')
            ->where('title', 'like', '%' . $request->term . '%')
            ->paginate(30);

        return view('{package}::{models}.index')->with('{models}', ${models});
    }

    public function create()
    {
        $this->authorize('create', {Model}::class);

        return view('{package}::{models}.create');
    }

    public function store(Request $request)
    {
        $this->authorize('store', {Model}::class);

        $this->validate($request, config('{package}.validation.{models}.create_form'));

        $this->dispatch(new SaveNew{Model}($request));

        return redirect()->route('larapress.{models}.index');
    }

    public function edit($id)
    {
        $this->authorize('edit', {Model}::class);

        ${model} = {Model}::findOrFail($id);

        return view('{package}::{models}.edit')->with('{model}', ${model});
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', {Model}::class);

        $this->validate($request, config('{package}.validation.{models}.update_form'));

        $this->dispatch(new UpdateExisting{Model}($id));

        return redirect()->route('larapress.{models}.index');
    }
}
