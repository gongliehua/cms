<?php

// 控制器
class ManageAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new ManageModel();
        parent::__construct($_tpl, $_model);
    }

    // 流程控制器
    public function _action()
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
        parent::page($this->_model->getManageTotal());
        /*
        $_page = new Page($this->_model->getManageTotal(),PAGE_SIZE);
        $this->_model->limit = $_page->limit;
        */
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('add',false);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','管理员列表');
        $this->_tpl->assign('AllManage',$this->_model->getAllManage());
        /*
        $this->_tpl->assign('page',$_page->showPage());
        */
    }

    // 添加
    private function add()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['admin_user'])) Tool::alertBack('警告：用户名不得为空');
            if (Validate::checkLength($_POST['admin_user'],2,'min')) Tool::alertBack('警告：用户名不得小于2位');
            if (Validate::checkLength($_POST['admin_user'],20,'max')) Tool::alertBack('警告：用户名不得大于20位');
            if (Validate::checkNull($_POST['admin_pass'])) Tool::alertBack('警告：密码不得为空');
            if (Validate::checkLength($_POST['admin_pass'],6,'min')) Tool::alertBack('警告：密码不得小于6位');
            if (Validate::checkEquals($_POST['admin_pass'],$_POST['admin_notpass'])) Tool::alertBack('警告：密码和密码确认必须一致');
            $this->_model->admin_user = $_POST['admin_user'];
            if ($this->_model->getOneManage()) Tool::alertBack('警告：此用户已被占用');
            $this->_model->admin_pass = sha1($_POST['admin_pass']);
            $this->_model->level = $_POST['level'];
            $this->_model->addManage() ? Tool::alertLocation('恭喜你，新增管理员成功！','manage.php?action=show') : Tool::alertBack('很遗憾，新增管理员失败！');
        }
        $this->_tpl->assign('show',false);
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','新增管理员');
        $_level = new LevelModel();
        $this->_tpl->assign('AllLevel',$_level->getAllLevel());
    }

    // 修改
    private function update()
    {
        if (isset($_POST['send'])) {
            $this->_model->id = $_POST['id'];
            if (trim($_POST['admin_pass']) == '') {
                $this->_model->admin_pass = $_POST['pass'];
            } else {
                if (Validate::checkLength($_POST['admin_pass'],6,'min')) Tool::alertBack('警告：密码不得小于6位');
                $this->_model->admin_pass = sha1($_POST['admin_pass']);
            }
            $this->_model->admin_pass = sha1($_POST['admin_pass']);
            $this->_model->level = $_POST['level'];
            $this->_model->updateManage() ? Tool::alertLocation('恭喜你，修改管理员成功！','manage.php?action=show') : Tool::alertBack('很遗憾，修改管理员失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_manage = $this->_model->getOneManage();
            is_object($_manage) ? true : Tool::alertBack('管理员传值的ID有误！');
            $this->_tpl->assign('id',$_manage->id);
            $this->_tpl->assign('level',$_manage->level);
            $this->_tpl->assign('admin_user',$_manage->admin_user);
            $this->_tpl->assign('admin_pass',$_manage->admin_pass);
            $this->_tpl->assign('show',false);
            $this->_tpl->assign('add',false);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('title','修改管理员');
            $_level = new LevelModel();
            $this->_tpl->assign('AllLevel',$_level->getAllLevel());
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // 删除
    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $this->_model->deleteManage() ? Tool::alertLocation('恭喜你，删除管理员成功！','manage.php?action=show') : Tool::alertBack('很遗憾，删除管理员失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
    }
}
