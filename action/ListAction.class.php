<?php

// 控制器
class ListAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl);
    }

    // 获取前台显示到货
    public function getNav()
    {
        if (isset($_GET['id'])) {
            $_nav = new NavModel();
            $_nav->id = $_GET['id'];
            if ($_result = $_nav->getOneNav()) {
                // 主导航
                $_navMain = '<a href="/list.php?id='.$_result->id.'">'.$_result->nav_name.'</a>';
                $this->_tpl->assign('nav', $_navMain);
                // 子导航
                $this->_tpl->assign('childNav', $_nav->getAllChildFrontNav());
            } else {
                Tool::alertBack('警告: 此导航不存在!');
            }
        } else {
            Tool::alertBack('警告: 非法操作!');
        }
    }
}
