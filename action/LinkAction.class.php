<?php

// 控制器
class LinkAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new LinkModel();
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
            case 'state':
                $this->state();
                break;
            default:
                Tool::alertBack('非法操作！');
        }
    }

    private function _showModule()
    {
        $this->_tpl->assign('show', false);
        $this->_tpl->assign('add', false);
        $this->_tpl->assign('update', false);
    }

    // 列表
    private function show()
    {
        $this->_showModule();
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('title','链接列表');
        parent::page($this->_model->getLinkTotal());
        $_object = $this->_model->getAllLink();
        $_object = Tool::subStr($_object,'weburl',20,'utf-8');
        $_object = Tool::subStr($_object,'logourl',20,'utf-8');
        if ($_object) {
            foreach ($_object as $_value) {
                switch ($_value->type) {
                    case 1:
                        $_value->type = '文字链接';
                        break;
                    case 2:
                        $_value->type = 'Logo链接';
                        break;
                }
                if (empty($_value->state)) {
                    $_value->state = '<span class="red">未审核</span> | <a href="link.php?action=state&type=ok&id='.$_value->id.'">通过</a>';
                } else {
                    $_value->state = '<span class="green">已通过</span> | <a href="link.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
                }
            }
        }
        $this->_tpl->assign('AllLink', $_object);
    }

    // state审核
    private function state() {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            if (!$this->_model->getOneLink()) {
                Tool::alertBack('警告：不存在此链接！');
            }
            if ($_GET['type'] == 'ok') {
                if ($this->_model->setStateOk()) {
                    Tool::alertLocation(null,'link.php?action=show');
                } else {
                    Tool::alertBack('警告：确认失败！');
                }
            } elseif ($_GET['type'] == 'cancel') {
                if ($this->_model->setStateCancel()) {
                    Tool::alertLocation(null,'link.php?action=show');
                } else {
                    Tool::alertBack('警告：取消失败！');
                }
            } else {
                Tool::alertBack('警告：非常操作！');
            }
        } else {
            Tool::alertBack('警告：非常操作！');
        }
    }

    // 添加
    private function add()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['webname'])) Tool::alertBack('警告：网站名称不得为空');
            if (Validate::checkLength($_POST['webname'],20,'max')) Tool::alertBack('警告：网站名称不得大于20位');
            if (Validate::checkNull($_POST['weburl'])) Tool::alertBack('警告：网站地址不得为空');
            if (Validate::checkLength($_POST['weburl'],100,'max')) Tool::alertBack('警告：网站地址不得大于100位');
            if ($_POST['type'] == '2') {
                if (Validate::checkNull($_POST['logourl'])) Tool::alertBack('警告：LOGO地址不得为空');
                if (Validate::checkLength($_POST['logourl'],100,'max')) Tool::alertBack('警告：LOGO地址不得大于100位');
            }
            if (Validate::checkLength($_POST['user'],20,'max')) Tool::alertBack('警告：站长名字不得大于20位');

            $this->_model->webname = $_POST['webname'];
            $this->_model->weburl = $_POST['weburl'];
            $this->_model->logourl = $_POST['logourl'];
            $this->_model->user = $_POST['user'];
            $this->_model->type = $_POST['type'];
            $this->_model->state = $_POST['state'];
            $this->_model->addLink() ? Tool::alertLocation('恭喜你，新增链接成功！','link.php?action=show') : Tool::alertBack('很遗憾，新增链接失败！');
        }
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('title','新增链接');
    }

    // 修改
    private function update()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['webname'])) Tool::alertBack('警告：网站名称不得为空');
            if (Validate::checkLength($_POST['webname'],20,'max')) Tool::alertBack('警告：网站名称不得大于20位');
            if (Validate::checkNull($_POST['weburl'])) Tool::alertBack('警告：网站地址不得为空');
            if (Validate::checkLength($_POST['weburl'],100,'max')) Tool::alertBack('警告：网站地址不得大于100位');
            if ($_POST['type'] == '2') {
                if (Validate::checkNull($_POST['logourl'])) Tool::alertBack('警告：LOGO地址不得为空');
                if (Validate::checkLength($_POST['logourl'],100,'max')) Tool::alertBack('警告：LOGO地址不得大于100位');
            }
            if (Validate::checkLength($_POST['user'],20,'max')) Tool::alertBack('警告：站长名字不得大于20位');

            $this->_model->id = $_POST['id'];
            if (!$this->_model->getOneLink()) Tool::alertBack('该信息不存在，建议属性页面后重试！');
            $this->_model->webname = $_POST['webname'];
            $this->_model->weburl = $_POST['weburl'];
            $this->_model->logourl = $_POST['logourl'];
            $this->_model->user = $_POST['user'];
            $this->_model->type = $_POST['type'];
            $this->_model->state = $_POST['state'];
            $this->_model->updateLink() ? Tool::alertLocation('恭喜你，修改链接成功！','link.php?action=show') : Tool::alertBack('很遗憾，修改链接失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_link = $this->_model->getOneLink();
            if (!$_link) {
                Tool::alertBack('警告：该信息不存在，建议刷新页面后重试！');
            }
            $this->_tpl->assign('id',$_link->id);
            $this->_tpl->assign('webname',$_link->webname);
            $this->_tpl->assign('weburl',$_link->weburl);
            $this->_tpl->assign('logourl',$_link->logourl);
            $this->_tpl->assign('user',$_link->user);
            $this->_tpl->assign('type',$_link->type);
            $this->_tpl->assign('state',$_link->state);
            $this->_tpl->assign('update',true);
            if ($_link->type == '1') {
                $this->_tpl->assign('type_left','checked');
                $this->_tpl->assign('type_right','');
                $this->_tpl->assign('logourl_show','display:none;');
            } else {
                $this->_tpl->assign('type_left','');
                $this->_tpl->assign('type_right','checked');
                $this->_tpl->assign('lgoourl_show','display:block;');
            }
            $this->_tpl->assign('title','修改链接');
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // 删除
    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $this->_model->deleteLink() ? Tool::alertLocation('恭喜你，删除链接成功！','link.php?action=show') : Tool::alertBack('很遗憾，删除链接失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
    }
}
