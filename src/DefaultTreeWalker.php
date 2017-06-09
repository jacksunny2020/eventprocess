<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jacksunny\EventProcess;

use Jacksunny\EventProcess\EventTransporterContract;
use Jacksunny\EventProcess\TreeWalkerContract;

/**
 * 用于在树中遍历查找节点或节点数组的类
 *
 * @author 施朝阳
 * @date 2017-5-5 9:26:26
 */
class DefaultTreeWalker implements TreeWalkerContract {

    /**
     * 查找指定发送者和接收者在组织树中最短路径上所有节点
     */
    public function findPathNodesAmongSendAndReceiver(EventTransporterContract $event_sender, EventTransporterContract $event_receiver) {
        return array(\App\Model\User::first());
    }

    /**
     * 查找指定节点所在树的根节点
     */
    public function findRootNode(EventTransporterContract $event_sender) {
        return \App\Model\User::first();
    }

}
