<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jacksunny\EventProcess;

use Jacksunny\EventProcess\EventTransporterContract;

/**
 *
 * @author 施朝阳
 * @date 2017-6-8 17:46:42
 */
interface EventContract {

//    function callNodeProcessors(EventTransporterContract $node);
    //错误代码
    function getErrorCode();

    //事件发出者
    function getEventSender();

    //用于在组织树中遍历的遍历者对象
    function getTreeWalker();

    //事件接收者
    function getEventReceivers();

    //是否通知子接受者比如部门下所有员工
    function getIsNotifySubreceivers();

    //请求对象
    function getRequest();

    //上下文实体对象
    function getEntity();

    //动作名称
    function getActionName();

    //可选其他参数
    function getOptions();
}
