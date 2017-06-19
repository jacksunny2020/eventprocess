<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jacksunny\EventProcess;

use Jacksunny\EventProcess\TreeNodeContract;

/**
 *
 * @author 施朝阳
 * @date 2017-5-4 19:03:47
 */
interface EventTransporterContract extends TreeNodeContract {
    //put your code here
    function getRoleCode();
}
