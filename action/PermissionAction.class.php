<?php

// 控制器
class PermissionAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new PermissionModel();
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
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('add',false);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','权限列表');
        parent::page($this->_model->getPermissionTotal());
        $_object = $this->_model->getAllPermission();
        $_object = Tool::subStr($_object, 'info', 30,'utf-8');
        $this->_tpl->assign('AllPermission', $_object);
    }

    // 添加
    private function add()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['name'])) Tool::alertBack('警告：权限名称不得为空');
            if (Validate::checkLength($_POST['name'],2,'min')) Tool::alertBack('警告：权限名称不得小于2位');
            if (Validate::checkLength($_POST['name'],100,'max')) Tool::alertBack('警告：权限名称不得大于100位');
            if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：描述不得大于200位');
            $this->_model->name = $_POST['name'];
            $this->_model->info = $_POST['info'];
            if ($this->_model->getOnePermission()) Tool::alertBack('警告：该权限名称已存在');
            $this->_model->addPermission() ? Tool::alertLocation('恭喜你，新增权限成功！','permission.php?action=show') : Tool::alertBack('很遗憾，新增权限失败！');
        }
        $this->_tpl->assign('show',false);
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','新增权限');
    }

    // 修改
    private function update()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['name'])) Tool::alertBack('警告：权限名称不得为空');
            if (Validate::checkLength($_POST['name'],2,'min')) Tool::alertBack('警告：权限名称不得小于2位');
            if (Validate::checkLength($_POST['name'],100,'max')) Tool::alertBack('警告：权限名称不得大于100位');
            if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：描述不得大于200位');
            $this->_model->id = $_POST['id'];
            $this->_model->name = $_POST['name'];
            $this->_model->info = $_POST['info'];
            $this->_model->updatePermission() ? Tool::alertLocation('恭喜你，修改权限成功！','permission.php?action=show') : Tool::alertBack('很遗憾，修改权限失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_permission = $this->_model->getOnePermission();
            is_object($_permission) ? true : Tool::alertBack('权限不存在');
            $this->_tpl->assign('id',$_permission->id);
            $this->_tpl->assign('name',$_permission->name);
            $this->_tpl->assign('info',$_permission->info);
            $this->_tpl->assign('show',false);
            $this->_tpl->assign('add',false);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('title','修改权限');
        } else {
            Tool::alertBack('非法操作！');
        }
    }
   
   // 删除
    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $this->_model->deletePermission() ? Tool::alertLocation('恭喜你，删除权限成功！','permission.php?action=show') : Tool::alertBack('很遗憾，删除权限失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
    }
}
