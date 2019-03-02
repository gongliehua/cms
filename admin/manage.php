<?php

require substr(dirname(__FILE__),0,-6).'/init.inc.php';
require ROOT_PATH.'/model/Manage.class.php';

// 业务流程控制器
$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : 'list';
switch ($_GET['action']) {
    case 'list':
        $_tpl->assign('list',true);
        $_tpl->assign('add',false);
        $_tpl->assign('update',false);
        $_tpl->assign('delete',false);
        $_tpl->assign('title','管理员列表');
        break;
    case 'add':
        $_tpl->assign('list',false);
        $_tpl->assign('add',true);
        $_tpl->assign('update',false);
        $_tpl->assign('delete',false);
        $_tpl->assign('title','新增管理员');
        break;
    case 'update':
        $_tpl->assign('list',false);
        $_tpl->assign('add',false);
        $_tpl->assign('update',true);
        $_tpl->assign('delete',false);
        $_tpl->assign('title','修改管理员');
        break;
    case 'delete':
        $_tpl->assign('list',false);
        $_tpl->assign('add',false);
        $_tpl->assign('update',false);
        $_tpl->assign('delete',true);
        $_tpl->assign('title','删除管理员');
        break;
    default:
        echo '非法操作';
}

$_manage = new Manage();
$_tpl->assign('AllManage',$_manage->getManage());
$_tpl->display('manage.tpl');
