<?php

namespace Jacksunny\EventProcess;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Jacksunny\EventProcess\TestEvent;
use Jacksunny\EventProcess\EventContract;
use Jacksunny\EventProcess\DefaultEventDispatcher;
use Jacksunny\EventProcess\EventListenerContract;

abstract class BaseEventListener implements EventListenerContract {

    //具体的事件监听器而不仅仅是 BaseEventListener
    protected $concert_listener;
    //当要执行某个成员方法，成员方法不存在时是否要抛出异常
//    protected $no_method_throw = false;
    protected $no_method_throw = true;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(EventListenerContract $listener = null) {
        if (isset($listener)) {
            $this->concert_listener = $listener;
        } else {
            $this->concert_listener = $this;
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
        $dispatcher = new DefaultEventDispatcher($event, $this->concert_listener);
        return $dispatcher->dispatch();
    }

    /**
     * 对于事件EventContract发生被监听时，对于事件目标用户EventTransporterContract执行与事件属性ActionName同名的本类方法
     * 如果子类重写该方法，则可以更改针对某个事件某些目标用户的处理逻辑
     */
    public function executeNodeProcessors(EventContract $event, EventTransporterContract $node) {
        $method_name = $event->getActionName();
//        call_user_func_array(array($this, $method_name), array($event, $node));
        if (method_exists($this, $method_name)) {
            call_user_func_array(array($this, $method_name), array($event, $node));
        } else {
            if ($this->no_method_throw) {
                call_user_func_array(array($this, $method_name), array($event, $node));
            }
        }
    }

}
