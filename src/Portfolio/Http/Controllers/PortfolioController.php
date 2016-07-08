<?php

namespace Larapress\Portfolio\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Larapress\Pages\Jobs\SaveNewPage;
use Larapress\Pages\Jobs\UpdateExistingPage;
use Larapress\Pages\Models\Page;

class PortfolioController extends Controller
{
    /**
     * Index page for admin screen
     * @return $this
     */
    public function index()
    {
        $pages = Page::where('status', '!=', 'trashed')->paginate(30);

        return view('larapress::pages.index')->with('pages', $pages);
    }

    public function search(Request $request)
    {
        $pages = Page::where('status', '!=', 'trashed')
            ->where('title', 'like', '%' . $request->term . '%')
            ->paginate(30);

        return view('larapress::pages.index')->with('pages', $pages);
    }

    public function create()
    {
        return view('larapress::pages.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, config('larapress.page.create_form'));

        $this->dispatch(new SaveNewPage($request));

        return redirect()->route('larapress.pages.index');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);

        return view('larapress::pages.edit')->with('page', $page);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, config('larapress.page.update_form'));

        $this->dispatch(new UpdateExistingPage($id));

        return redirect()->route('larapress.pages.index');
    }
}
