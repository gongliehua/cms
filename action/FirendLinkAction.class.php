<?php

// 控制器
class FirendLinkAction extends Action {
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
            case 'frontshow':
                $this->frontshow();
                break;
            case 'frontadd':
                $this->frontadd();
                break;
            default:
                Tool::alertBack('非法操作！');
        }
    }

    private function _showModule()
    {
        $this->_tpl->assign('frontadd', false);
        $this->_tpl->assign('frontshow', false);
    }

    //前台新增
    private function frontadd()
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
            if (Validate::checkLength($_POST['code'],4,'equals')) Tool::alertBack('警告：验证码是4位');
            if (Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertBack('警告：验证码不正确');

            $this->_model->webname = $_POST['webname'];
            $this->_model->weburl = $_POST['weburl'];
            $this->_model->logourl = $_POST['logourl'];
            $this->_model->user = $_POST['user'];
            $this->_model->type = $_POST['type'];
            $this->_model->state = $_POST['state'];
            $this->_model->addLink() ? Tool::alertLocation('恭喜你，新增链接成功！','firendlink.php?action=frontshow') : Tool::alertBack('很遗憾，新增链接失败！');
        }
        $this->_showModule();
        $this->_tpl->assign('frontadd', true);
    }

    // 前台列表
    private function frontshow()
    {
        $this->_showModule();
        $this->_tpl->assign('frontshow', true);

        $_object = $this->_model->getAllTextLink();
        $this->_tpl->assign('AllText',$_object);
        $_object = $this->_model->getAllLogoLink();
        $this->_tpl->assign('AllLogo',$_object);
    }

    // 公开
    public function index()
    {
        $this->text();
        $this->logo();
    }

    // text
    private function text()
    {
        $_object = $this->_model->getTwentyTextLink();
        $this->_tpl->assign('text',$_object);
    }

    //logo
    private function logo()
    {
        $_object = $this->_model->getLineLogoLink();
        $this->_tpl->assign('logo',$_object);
    }
}
