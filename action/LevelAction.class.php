<?php

// 控制器
class LevelAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        Validate::checkSession();
        $_model = new LevelModel();
        parent::__construct($_tpl, $_model);
        $this->_action();
        $this->_tpl->display('level.tpl');
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
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('add',false);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','等级列表');
        $this->_tpl->assign('AllLevel',$this->_model->getAllLevel());
    }

    // 添加
    private function add()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['level_name'])) Tool::alertBack('警告：等级名称不得为空');
            if (Validate::checkLength($_POST['level_name'],2,'min')) Tool::alertBack('警告：等级名称不得小于2位');
            if (Validate::checkLength($_POST['level_name'],20,'max')) Tool::alertBack('警告：等级名称不得大于20位');
            if (Validate::checkLength($_POST['level_info'],255,'max')) Tool::alertBack('警告：描述不得大于255位');
            $this->_model->level_name = $_POST['level_name'];
            if ($this->_model->getOneLevel()) Tool::alertBack('警告：该等级名称已被占用');
            $this->_model->level_info = $_POST['level_info'];
            $this->_model->addLevel() ? Tool::alertLocation('恭喜你，新增等级成功！','level.php?action=show') : Tool::alertBack('很遗憾，新增等级失败！');
        }
        $this->_tpl->assign('show',false);
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','新增等级');
    }

    // 修改
    private function update()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['level_name'])) Tool::alertBack('警告：等级名称不得为空');
            if (Validate::checkLength($_POST['level_name'],2,'min')) Tool::alertBack('警告：等级名称不得小于2位');
            if (Validate::checkLength($_POST['level_name'],20,'max')) Tool::alertBack('警告：等级名称不得大于20位');
            if (Validate::checkLength($_POST['level_info'],255,'max')) Tool::alertBack('警告：描述不得大于255位');
            $this->_model->id = $_POST['id'];
            $this->_model->level_name = $_POST['level_name'];
            $this->_model->level_info = $_POST['level_info'];
            $this->_model->updateLevel() ? Tool::alertLocation('恭喜你，修改等级成功！','level.php?action=show') : Tool::alertBack('很遗憾，修改等级失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            is_object($this->_model->getOneLevel()) ? true : Tool::alertBack('等级传值的ID有误！');
            $this->_tpl->assign('id',$this->_model->getOneLevel()->id);
            $this->_tpl->assign('level_name',$this->_model->getOneLevel()->level_name);
            $this->_tpl->assign('level_info',$this->_model->getOneLevel()->level_info);
            $this->_tpl->assign('show',false);
            $this->_tpl->assign('add',false);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('title','修改等级');
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // 删除
    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_manage = new ManageModel();
            $_manage->level = $this->_model->id;
            if ($_manage->getOneManage()) Tool::alertBack('警告：该等级已有管理员使用,无法删除');
            $this->_model->deleteLevel() ? Tool::alertLocation('恭喜你，删除等级成功！','level.php?action=show') : Tool::alertBack('很遗憾，删除等级失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
    }
}
