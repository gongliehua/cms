<?php

// 控制器
class IndexAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl);
    }

    //执行
    public function _action() {
        $this->login();
        $this->laterUser();
    }

    // 最近登录的会员
    public function laterUser() {
        $_user = new UserModel();
        $this->_tpl->assign('AllLaterUser',$_user->getLaterUser());
    }

    //登录
    private function login() {
        $_cookie = new Cookie('user');
        $_user = $_cookie->getCookie();
        $_cookie = new Cookie('face');
        $_face = $_cookie->getCookie();
        if ($_user) {
            $this->_tpl->assign('login', false);
            $this->_tpl->assign('user', Tool::subStr($_user,null,8,'utf-8'));
            $this->_tpl->assign('face', $_face);
        } else {
            $this->_tpl->assign('login', true);
        }
        $this->_tpl->assign('cache',IS_CACHE);
        if (IS_CACHE) {
            $this->_tpl->assign('member','<script type="text/javascript">getIndexLogin();</script>');
        }
    }
}
