--php

namespace {Vendor}\{Package}\{Models}\Listeners;

use {Vendor}\{Package}\{Models}\Events\{Model}WasSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class {Model}SavedListener
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
    public function handle({Model}WasSaved $event)
    {

    }
}
