<?php

// 控制器
class NavAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        Validate::checkSession();
        $_model = new NavModel();
        parent::__construct($_tpl, $_model);
        $this->_action();
        $this->_tpl->display('nav.tpl');
    }

    // 流程控制器
    private function _action()
    {
        // 业务流程控制器
        $_GET['action'] = isset($_GET['action']) ? $_GET['action'] : 'show';
        switch ($_GET['action']) {
            case 'show':
                $this->show();
                break;
            case 'add':
                $this->add();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                Tool::alertBack('非法操作！');
        }
    }

    // 列表
    private function show()
    {
        $_page = new Page($this->_model->getNavTotal(),PAGE_SIZE);
        $this->_model->limit = $_page->limit;
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('add',false);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','导航列表');
        $this->_tpl->assign('AllNav',$this->_model->getAllNav());
        $this->_tpl->assign('page',$_page->showPage());
    }

    // 添加
    private function add()
    {
    }

    // 修改
    private function update()
    {
    }

    // 删除
    private function delete()
    {
    }
}
