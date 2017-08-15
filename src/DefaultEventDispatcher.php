<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jacksunny\EventProcess;

use Jacksunny\EventProcess\EventContract;
use Jacksunny\EventProcess\EventTransporterContract;
use \Exception;
use Jacksunny\EventProcess\EventListenerContract;

/**
 * Description of GeneralEventDispatcher
 * 默认的事件分发程序
 * @author 施朝阳
 * @date 2017-5-4 17:45:10
 */
class DefaultEventDispatcher extends AbsEventDispatcher implements EventDispatcherContract {

    public function __construct(EventContract $event, EventListenerContract $listener) {
        parent::__construct($event, $listener);
    }

    /**
     * 查找指定节点确定的目标接收者列表
     */
//    protected function findDestReceiversFromNode(EventContract $event, EventTransporterContract $node) {
//        return \App\Model\User::first();
//    }

}
