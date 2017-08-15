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

    /**
     * 返回实体在组织树上的编号，通常会在实体本身编号加上一个起始值作为最终编号
     * 如果实体是 platform 则返回的编号为 platform->id + 100000000
     * 如果实体是 brand 则返回的编号为 brand->id + 200000000
     * 如果实体是 company 则返回的编号为 company->id + 300000000
     * 如果实体是 branch 则返回的编号为 branch->id + 400000000
     * 如果实体是 user 则返回的编号为 user->id + 600000000
     * 如果实体是 merchant 则返回的编号为 merchant->id + 700000000
     * 如果实体是 store 则返回的编号为 merchant->id + 800000000
     * 如果实体是 agent 则返回的编号为 merchant->id + 900000000
     */
    function getTreeNodeId();

    function getEntityName();

    function getNodeType();

    /**
     * 返回实体的父实体在组织树上的编号，通常会在父实体本身编号加上一个起始值作为最终编号
     * 如果父实体是 platform 则返回的编号为 node_id + 100000000
     * 如果父实体是 brand 则返回的编号为 brand_id + 200000000
     * 如果父实体是 company 则返回的编号为 company_id + 300000000
     * 如果父实体是 branch 则返回的编号为 branch_id + 400000000
     * 如果父实体是 user 则返回的编号为 user_id + 600000000
     * 如果父实体是 merchant 则返回的编号为 merchant_id + 700000000
     * 如果父实体是 store 则返回的编号为 merchant_id + 800000000
     * 如果父实体是 agent 则返回的编号为 agent_id + 900000000
     */
    function getTreeNodeParentId();

    function getTreeNodeParentType();

    function getEntityStatus();
}
