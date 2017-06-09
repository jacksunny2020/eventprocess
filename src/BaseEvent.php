<?php

namespace Jacksunny\EventProcess;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Jacksunny\EventProcess\TreeWalkerContract;
use Illuminate\Http\Request;
use Jacksunny\EventProcess\EventContract;
use Jacksunny\EventProcess\EventTransporterContract;

/**
 * 事件基类，用于保存公共的属性
 */
abstract class BaseEvent implements EventContract {

    use Dispatchable,
        InteractsWithSockets,
        SerializesModels;

    //错误代码
    protected $error_code = '000000';
    //事件发出者
    protected $event_sender;
    //用于在组织树中遍历的遍历者对象
    protected $tree_walker;
    //事件接收者
    protected $event_receivers;
    //是否通知子接受者比如部门下所有员工
    protected $is_notify_subreceivers;
    //请求对象
    protected $request;
    //上下文实体对象
    protected $entity;
    //动作名称
    protected $action_name;
    //可选其他参数
    protected $options;

    public function __construct(TreeWalkerContract $tree_walker, EventTransporterContract $event_sender, Request $request, $entity, $action_name, Array $options = null, Array $event_receivers = null, $is_notify_subreceivers = false) {
        $this->tree_walker = $tree_walker;
        $this->event_sender = $event_sender;
        $this->request = $request;
        $this->entity = $entity;
        $this->action_name = $action_name;
        $this->options = $options;
        $this->event_receivers = $event_receivers;
        $this->is_notify_subreceivers = $is_notify_subreceivers;
    }

    public function getActionName() {
        return $this->action_name;
    }

    public function getEntity() {
        return $this->entity;
    }

    public function getErrorCode() {
        return $this->error_code;
    }

    public function getEventReceivers() {
        return $this->event_receivers;
    }

    public function getEventSender() {
        return $this->event_sender;
    }

    public function getIsNotifySubreceivers() {
        return $this->is_notify_subreceivers;
    }

    public function getOptions() {
        return $this->options;
    }

    public function getRequest() {
        return $this->request;
    }

    public function getTreeWalker() {
        return $this->tree_walker;
    }

}
