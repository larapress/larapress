<?php

namespace Larapress\Portfolio\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Larapress\Portfolio\Events\PortfolioWasSaved;

class TestListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  PageWasSaved  $event
     * @return void
     */
    public function handle(PortfolioWasSaved $event)
    {

    }
}
