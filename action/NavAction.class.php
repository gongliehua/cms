<?php

// 控制器
class NavAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new NavModel();
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
            case 'sort':
                $this->sort();
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
            case 'addChild':
                $this->addChild();
                break;
            case 'showChild':
                $this->showChild();
                break;
            default:
                Tool::alertBack('非法操作！');
        }
    }

    // 前台
    public function showFront()
    {
        $this->_tpl->assign('FrontNav',$this->_model->getFrontNav());
    }

    // 后台排序
    public function sort()
    {
        if (isset($_POST['send'])) {
            $this->_model->sort = $_POST['sort'];
            $this->_model->setNavSort();
        }
        Tool::alertLocation(null, 'nav.php?action=show');
    }

    // addChild
    private function addChild()
    {
        if (isset($_POST['send'])) {
            $this->add();
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_nav = $this->_model->getOneNav();
            is_object($_nav) ? true : Tool::alertBack('导航传值的ID有误！');
            $this->_tpl->assign('id',$_nav->id);
            $this->_tpl->assign('prev_name',$_nav->nav_name);
            $this->_tpl->assign('show',false);
            $this->_tpl->assign('add',false);
            $this->_tpl->assign('update',false);
            $this->_tpl->assign('addChild',true);
            $this->_tpl->assign('showChild',false);
            $this->_tpl->assign('title','新增子导航');
        }
    }

    // showChild
    private function showChild()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_nav = $this->_model->getOneNav();
            is_object($_nav) ? true : Tool::alertBack('导航传值的ID有误！');
            $_page = new Page($this->_model->getChildNavTotal(),PAGE_SIZE);
            $this->_model->limit = $_page->limit;
            $this->_tpl->assign('id',$_nav->id);
            $this->_tpl->assign('prev_name',$_nav->nav_name);
            $this->_tpl->assign('show',false);
            $this->_tpl->assign('add',false);
            $this->_tpl->assign('update',false);
            $this->_tpl->assign('addChild',false);
            $this->_tpl->assign('showChild',true);
            $this->_tpl->assign('title','子导航列表');
            $this->_tpl->assign('AllChildNav',$this->_model->getAllChildNav());
            $this->_tpl->assign('page',$_page->showPage());
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
        $this->_tpl->assign('addChild',false);
        $this->_tpl->assign('showChild',false);
        $this->_tpl->assign('title','导航列表');
        $this->_tpl->assign('AllNav',$this->_model->getAllNav());
        $this->_tpl->assign('page',$_page->showPage());
    }

    // 添加
    private function add()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['nav_name'])) Tool::alertBack('警告：导航名称不得为空');
            if (Validate::checkLength($_POST['nav_name'],2,'min')) Tool::alertBack('警告：导航名称不得小于2位');
            if (Validate::checkLength($_POST['nav_name'],20,'max')) Tool::alertBack('警告：导航名称不得大于20位');
            if (Validate::checkLength($_POST['nav_info'],255,'max')) Tool::alertBack('警告：描述不得大于255位');
            $this->_model->nav_name = $_POST['nav_name'];
            if ($this->_model->getOneNav()) Tool::alertBack('警告：该导航名称已被占用');
            $this->_model->nav_info = $_POST['nav_info'];
            $this->_model->pid = isset($_POST['pid']) ? $_POST['pid'] : 0;
            $this->_model->addNav() ? Tool::alertLocation('恭喜你，新增导航成功！','nav.php?action=show') : Tool::alertBack('很遗憾，新增导航失败！');
        }
        $this->_tpl->assign('show',false);
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('addChild',false);
        $this->_tpl->assign('showChild',false);
        $this->_tpl->assign('title','新增导航');
    }

    // 修改
    private function update()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['nav_name'])) Tool::alertBack('警告：导航名称不得为空');
            if (Validate::checkLength($_POST['nav_name'],2,'min')) Tool::alertBack('警告：导航名称不得小于2位');
            if (Validate::checkLength($_POST['nav_name'],20,'max')) Tool::alertBack('警告：导航名称不得大于20位');
            if (Validate::checkLength($_POST['nav_info'],255,'max')) Tool::alertBack('警告：描述不得大于255位');
            $this->_model->id = $_POST['id'];
            $this->_model->nav_name = $_POST['nav_name'];
            $this->_model->nav_info = $_POST['nav_info'];
            $this->_model->updateNav() ? Tool::alertLocation('恭喜你，修改导航成功！','nav.php?action=show') : Tool::alertBack('很遗憾，修改导航失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_nav = $this->_model->getOneNav();
            is_object($_nav) ? true : Tool::alertBack('导航传值的ID有误！');
            $this->_tpl->assign('id',$_nav->id);
            $this->_tpl->assign('nav_name',$_nav->nav_name);
            $this->_tpl->assign('nav_info',$_nav->nav_info);
            $this->_tpl->assign('show',false);
            $this->_tpl->assign('add',false);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('addChild',false);
            $this->_tpl->assign('showChild',false);
            $this->_tpl->assign('title','修改导航');
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // 删除
    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $this->_model->deleteNav() ? Tool::alertLocation('恭喜你，删除导航成功！','nav.php?action=show') : Tool::alertBack('很遗憾，删除导航失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
    }
}
