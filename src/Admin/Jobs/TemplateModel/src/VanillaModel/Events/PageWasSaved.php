--php

namespace {Vendor}\{Package}\{Models}\Events;

use \App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use {Vendor}\{Package}\{Models}\Models\{Model};

class {Model}WasSaved extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct({Model} ${model})
    {
        $this->{model} = ${model};
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
