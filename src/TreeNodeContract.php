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
 * @date 2017-6-19 15:10:45
 */
interface TreeNodeContract {

    function getId();

    function getEntityName();

    function getNodeType();

    function getParentId();

    function getEntityStatus();
}
