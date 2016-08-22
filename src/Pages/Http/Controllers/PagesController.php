<?php

namespace Larapress\Pages\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Larapress\Pages\Jobs\SaveNewPage;
use Larapress\Pages\Jobs\UpdateExistingPage;
use Larapress\Pages\Models\Page;

class PagesController extends Controller
{
    /**
     * Index page for admin screen
     * @return $this
     */
    public function index()
    {
        $this->authorize('index', Page::class);

        $pages = Page::where('status', '!=', 'trashed')->paginate(30);

        return view('larapress::pages.index')->with('pages', $pages);
    }

    public function search(Request $request)
    {
        $this->authorize('search', Page::class);

        $pages = Page::where('status', '!=', 'trashed')
            ->where('title', 'like', '%' . $request->term . '%')
            ->paginate(30);

        return view('larapress::pages.index')->with('pages', $pages);
    }

    public function create()
    {
        $this->authorize('create', Page::class);

        return view('larapress::pages.create');
    }

    public function store(Request $request)
    {
        $this->authorize('store', Page::class);

        $this->validate($request, config('larapress.page.create_form'));

        $this->dispatch(new SaveNewPage($request));

        return redirect()->route('larapress.pages.index');
    }

    public function edit($id)
    {
        $this->authorize('edit', Page::class);

        $page = Page::findOrFail($id);

        return view('larapress::pages.edit')->with('page', $page);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Page::class);

        $this->validate($request, config('larapress.page.update_form'));

        $this->dispatch(new UpdateExistingPage($id));

        return redirect()->route('larapress.pages.index');
    }
}
