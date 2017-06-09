<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jacksunny\EventProcess;

use Jacksunny\EventProcess\EventContract;
use Jacksunny\EventProcess\EventTransporterContract;

/**
 *
 * @author 施朝阳
 * @date 2017-6-9 15:06:17
 */
interface EventListenerContract {

    function executeNodeProcessors(EventContract $event, EventTransporterContract $node);
}
