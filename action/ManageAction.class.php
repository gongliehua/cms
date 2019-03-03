<?php

// 控制器
class ManageAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new ManageModel();
        parent::__construct($_tpl, $_model);
        $this->_action();
        $this->_tpl->display('manage.tpl');
    }

    // 流程控制器
    private function _action()
    {
        // 业务流程控制器
        $_GET['action'] = isset($_GET['action']) ? $_GET['action'] : 'list';
        switch ($_GET['action']) {
            case 'list':
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
        $this->_tpl->assign('list',true);
        $this->_tpl->assign('add',false);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','管理员列表');
        $this->_tpl->assign('AllManage',$this->_model->getManage());
    }

    // 添加
    private function add()
    {
        if (isset($_POST['send'])) {
            $this->_model->admin_user = $_POST['admin_user'];
            $this->_model->admin_pass = sha1($_POST['admin_pass']);
            $this->_model->level = $_POST['level'];
            $this->_model->addManage() ? Tool::alertLocation('恭喜你，新增管理员成功！','manage.php?action=list') : Tool::alertBack('很遗憾，新增管理员失败！');
        }
        $this->_tpl->assign('list',false);
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','新增管理员');
    }

    // 修改
    private function update()
    {
        if (isset($_POST['send'])) {
            $this->_model->id = $_POST['id'];
            $this->_model->admin_pass = sha1($_POST['admin_pass']);
            $this->_model->level = $_POST['level'];
            $this->_model->updateManage() ? Tool::alertLocation('恭喜你，修改管理员成功！','manage.php?action=list') : Tool::alertBack('很遗憾，修改管理员失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            is_object($this->_model->getOneManage()) ? true : Tool::alertBack('您传值的ID有误！');
            $this->_tpl->assign('id',$this->_model->getOneManage()->id);
            $this->_tpl->assign('level',$this->_model->getOneManage()->level);
            $this->_tpl->assign('admin_user',$this->_model->getOneManage()->admin_user);
            $this->_tpl->assign('list',false);
            $this->_tpl->assign('add',false);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('title','修改管理员');
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // 删除
    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $this->_model->deleteManage() ? Tool::alertLocation('恭喜你，删除管理员成功！','manage.php?action=list') : Tool::alertBack('很遗憾，删除管理员失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
    }
}
