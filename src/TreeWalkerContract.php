<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jacksunny\EventProcess;

/**
 *
 * @author 施朝阳
 * @date 2017-5-5 9:28:49
 */
interface TreeWalkerContract {
    /**
     * 查找指定发送者和接收者在组织树中最短路径上所有节点
     */
    function findPathNodesAmongSendAndReceiver(EventTransporterContract $event_sender, EventTransporterContract $event_receiver);

    /**
     * 查找指定节点所在树的根节点
     */
    function findRootNode(EventTransporterContract $event_sender) ;
}
