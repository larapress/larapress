<?php

namespace Larapress\Portfolio\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Larapress\Portfolio\Jobs\SaveNewPortfolio;
use Larapress\Portfolio\Jobs\UpdateExistingPortfolio;
use Larapress\Portfolio\Models\Portfolio;

class PortfolioController extends Controller
{
    /**
     * Index portfolio for admin screen
     * @return $this
     */
    public function index()
    {
        $portfolio = Portfolio::where('status', '!=', 'trashed')->paginate(30);

        return view('larapress::portfolio.index')->with('portfolio', $portfolio);
    }

    public function search(Request $request)
    {
        $portfolio = Portfolio::where('status', '!=', 'trashed')
            ->where('title', 'like', '%' . $request->term . '%')
            ->paginate(30);

        return view('larapress::portfolio.index')->with('portfolio', $portfolio);
    }

    public function create()
    {
        return view('larapress::portfolio.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, config('larapress.portfolio.create_form'));

        $this->dispatch(new SaveNewPortfolio($request));

        return redirect()->route('larapress.portfolio.index');
    }

    public function edit($id)
    {
        $project = Portfolio::findOrFail($id);

        return view('larapress::portfolio.edit')->with('project', $project);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, config('larapress.portfolio.update_form'));

        $this->dispatch(new UpdateExistingPortfolio($id));

        return redirect()->route('larapress.portfolio.index');
    }
}
