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
 * @date 2017-6-9 15:43:01
 */
interface EventDispatcherContract {

    //初始事件对象
    function getEvent();

    //树遍历者对象，用于在树中找到对应的节点或节点数组
    function getTreeWalker();

    //事件监听器类
    function getListener();

    //事件具体分发机制
    function dispatch();
}
