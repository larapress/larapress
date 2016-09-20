<?php

namespace Larapress\Pages\Listeners;

use Larapress\Pages\Events\PageWasSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
    public function handle(PageWasSaved $event)
    {

    }
}
