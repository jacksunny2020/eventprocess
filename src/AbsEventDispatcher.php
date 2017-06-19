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
use Jacksunny\EventProcess\EventDispatcherContract;
use App;

/**
 * Description of GeneralEventDispatcher
 *
 * @author 施朝阳
 * @date 2017-5-4 17:45:10
 */
abstract class AbsEventDispatcher implements EventDispatcherContract {

    //初始事件对象
    protected $event;
    //树遍历者对象，用于在树中找到对应的节点或节点数组
    protected $tree_walker;
    //事件监听器类
    protected $listener;

    public function __construct(EventContract $event, EventListenerContract $listener) {
        $this->event = $event;
        //$this->tree_walker = $tree_walker;
        $this->tree_walker = $this->event->getTreeWalker();
        if (!isset($this->tree_walker)) {
            $this->tree_walker = App::make(TreeWalkerContract::class);
        }
        $this->listener = $listener;
    }

    /**
     * 事件在组织树中分发
     * 如果有指定目标接受者,直接确定发送者与接收者最短路径，路径上每个节点判断是否要处理，需要处理的调用该节点处理器列表来处理，否则继续路径前进直到结束
     * 如果没有指定目标接收者，向着根节点方向前进，调用每个节点是否能确定目标，能确定目标的话创建新消息给指定目标并规划处该节点到目标节点最近路径进行处理，等待所有新消息处理完成后返回
     * 大多数情况下都会由根节点来确定目标接收者，然后创建N个新消息分别给目标接收者，并根据确定的根节点到指定目标接收者的最短路径沿路下行，各节点根据是否可以处理这类情况来拦截处理
     */
    public function dispatch() {
        $event_sender = $this->event->getEventSender();
        $event_receivers = $this->event->getEventReceivers();
        if (null == $event_sender || !isset($event_sender)) {
            throw new Exception("请提供事件发送者");
        }

        if ($this->isNotEmptyArray($event_receivers)) {
            foreach ($event_receivers as $event_receiver) {
                //确定发送者和接收者之间最短路径上的所有节点
                $array_node_on_path = $this->tree_walker->findPathNodesAmongSendAndReceiver($event_sender, $event_receiver);
                if ($this->isNotEmptyArray($array_node_on_path)) {
                    foreach ($array_node_on_path as $node_on_path) {
//                        $array_node_processors = $this->findNodeProcessors($this->event, $node_on_path);
//                        if ($this->isNotEmptyArray($array_node_processors)) {
//                            foreach ($array_node_processors as $node_processor) {
//                                $node_processor->execute($this->event, $node_on_path);
//                            }
//                        }
                        $this->callNodeProcessors($this->event, $node_on_path);
                    }
                }
            }
        } else {
            //确定发送者和根节点之间最短路径上的所有节点
            $root_node = $this->tree_walker->findRootNode($event_sender);
            $event_receiver = $root_node;
            if (null == $event_receiver || !isset($event_receiver)) {
                throw new Exception("未能在组织树上找到根节点，请联系管理员");
            }
            $array_node_to_root = $this->tree_walker->findPathNodesAmongSendAndReceiver($event_sender, $event_receiver);
            if ($this->isNotEmptyArray($array_node_to_root)) {
                foreach ($array_node_to_root as $node_to_root) {
//                     $array_node_processors = $this->findNodeProcessors($this->event, $node_to_root);
//                        if ($this->isNotEmptyArray($array_node_processors)) {
//                            foreach ($array_node_processors as $node_processor) {
//                                $node_processor->execute($this->event, $node_to_root);
//                            }
//                        }
                    $this->callNodeProcessors($this->event, $node_to_root);
                }
            }
        }
        return true;
    }

    /**
     * 是否为非空数组
     */
    public function isNotEmptyArray($array) {
        return null != $array && isset($array) && count($array) > 0;
    }

    /**
     * 查找指定节点相关的处理器对象列表
     */
//    abstract protected function findNodeProcessors(BaseEvent $event, EventTransporterContract $nodeToRoot);

    protected function callNodeProcessors(EventContract $event, EventTransporterContract $node) {
        return $this->listener->executeNodeProcessors($event, $node);
    }

    public function getEvent() {
        return $this->event;
    }

    public function getListener() {
        return $this->listener;
    }

    public function getTreeWalker() {
        return $this->tree_walker;
    }

}
