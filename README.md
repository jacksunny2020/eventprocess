# eventprocess
simple event process plugin including dispatching on tree for laravel framework

# How to install and configurate package

1. install the laravel package 
  composer require "jacksunny/eventprocess":"dev-master"
  
  please check exist line "minimum-stability": "dev" in composer.json if failed

2. append new service provider file line in the section providers of file app.config
  after appended,it should looks like
  <pre>
   'providers' => [
        Illuminate\Auth\AuthServiceProvider::class,
        ......
        Jacksunny\EventProcess\EventProcessServiceProvider::class,
    ],
   </pre>
3.  create event class TestEvent
    <pre>
    class TestEvent extends BaseEvent implements EventContract {

    public $context_obj;

    public function __construct(User $user, Request $request, $entity, $action_name, array $options = null, TreeWalkerContract $tree_walker = null) {
        parent::__construct($tree_walker, $user, $request, $entity, $action_name, $options);
        $this->context_obj = $user;
    }
    </pre>
    
4.  create event listener class TestEventListener
    <pre>
    class TestEventListener extends BaseEventListener implements EventListenerContract {

    public function __construct() {
        parent::__construct($this);
    }

    public function handle(TestEvent $event) {
        parent::handle($event);

        //other process code on this event type
    }
    </pre>

  
5. please notify me if you got any problem or error on it,thank you!
