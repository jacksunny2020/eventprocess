<?php

namespace Jacksunny\EventProcess;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Jacksunny\EventProcess\TestEvent;
use Jacksunny\EventProcess\EventContract;
use Jacksunny\EventProcess\DefaultEventDispatcher;
use Jacksunny\EventProcess\EventListenerContract;

abstract class BaseEventListener implements EventListenerContract {

    protected $listener;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(EventListenerContract $listener = null) {
        if (isset($listener)) {
            $this->listener = $listener;
        } else {
            $this->listener = $this;
        }
    }

    /**
     * Handle the event.
     * 事件处理，使用默认的 EventDispatcher 来分发事件到合适的接收者(人，部门或角色或综合)
     *
     * @param  BaseEvent  $event
     * @return void
     */
    public function handle(EventContract $event) {
        $dispatcher = new DefaultEventDispatcher($event, $this->listener);
        return $dispatcher->dispatch();
    }

    public function executeNodeProcessors(EventContract $event, EventTransporterContract $node) {
        $method_name = $event->getActionName();
        call_user_func_array(array($this, $method_name), array($event, $node));
    }

}
