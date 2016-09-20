<?php

namespace Larapress\Posts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Larapress\Posts\Jobs\SaveNewPost;
use Larapress\Posts\Jobs\UpdateExistingPost;
use Larapress\Posts\Models\Post;

class PostsController extends Controller
{
    /**
     * Index post for admin screen
     * @return $this
     */
    public function index()
    {
        $posts = Post::where('status', '!=', 'trashed')->paginate(30);

        $title = 'All blog posts';

        return view('larapress::posts.index')->with('posts', $posts)->with('title', $title);
    }

    /**
     * Indexes post in a category
     * @param string $category
     * @return mixed
     */
    public function category($category)
    {
        $posts = Post::inCategory($category);

        $title = 'All blog posts in ' . $category;

        return view('larapress::posts.index')->with('posts', $posts)->with('title', $title);
    }

    public function search(Request $request)
    {
        $posts = Post::where('status', '!=', 'trashed')
            ->where('title', 'like', '%' . $request->term . '%')
            ->paginate(30);

        return view('larapress::posts.index')->with('posts', $posts);
    }

    public function create()
    {
        return view('larapress::posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, config('larapress.post.create_form'));

        $this->dispatch(new SaveNewpost($request));

        return redirect()->route('larapress.posts.index');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('larapress::posts.edit')->with('post', $post);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, config('larapress.post.update_form'));

        $this->dispatch(new UpdateExistingpost($id));

        return redirect()->route('larapress.posts.index');
    }
}
