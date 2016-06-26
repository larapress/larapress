<?php

namespace Larapress\Galleries\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Larapress\Galleries\Jobs\SaveNewGallery;
use Larapress\Galleries\Jobs\UpdateExistingGallery;
use Larapress\Galleries\Models\Gallery;

class GalleriesController extends Controller
{
    /**
     * Index page for admin screen
     * @return $this
     */
    public function index()
    {
        $galleries = Gallery::where('status', '!=', 'trashed')->paginate(30);

        return view('larapress::galleries.index')->with('galleries', $galleries);
    }

    public function search(Request $request)
    {
        $galleries = Gallery::where('status', '!=', 'trashed')
            ->where('title', 'like', '%' . $request->term . '%')
            ->paginate(30);

        return view('larapress::galleries.index')->with('galleries', $galleries);
    }

    public function create()
    {
        return view('larapress::galleries.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, config('larapress.gallery.create_form'));

        $this->dispatch(new SaveNewGallery($request));

        return redirect()->route('larapress.galleries.index');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('larapress::galleries.edit')->with('gallery', $gallery);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, config('larapress.gallery.update_form'));

        $this->dispatch(new UpdateExistingGallery($id));

        return redirect()->route('larapress.galleries.index');
    }
}
