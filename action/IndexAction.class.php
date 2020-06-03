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
        $this->showList();
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

    // 显示推荐，本月热点，本月评论，头条
    public function showList() {
        $model = new ContentModel();
        parent::__construct($this->_tpl,$model);

        $_object = $this->_model->getNewRecList();
        $_object = Tool::subStr($_object,'title',8,'utf-8');
        Tool::objDate($_object,'date');
        $this->_tpl->assign('NewRecList', $_object);

        $_object = $this->_model->getMonthHotList();
        $_object = Tool::subStr($_object,'title',8,'utf-8');
        Tool::objDate($_object,'date');
        $this->_tpl->assign('MonthHotList', $_object);

        $_object = $this->_model->getMonthCommentList();
        $_object = Tool::subStr($_object,'title',8,'utf-8');
        Tool::objDate($_object,'date');
        $this->_tpl->assign('MonthCommentList', $_object);

        $_object = $this->_model->getPicList();
        $_object = Tool::subStr($_object,'title',20,'utf-8');
        Tool::objDate($_object,'date');
        $this->_tpl->assign('PicList', $_object);

        $_object = $this->_model->getNewList();
        $_object = Tool::subStr($_object,'title',24,'utf-8');
        Tool::objDate($_object,'date');
        $this->_tpl->assign('NewList', $_object);

        $_object = $this->_model->getNewTop();
        $this->_tpl->assign('TopTitle', Tool::subStr($_object->title,null,24,'utf-8'));
        $this->_tpl->assign('TopInfo', Tool::subStr($_object->info,null,80,'utf-8'));
        $this->_tpl->assign('TopId', $_object->id);

        $_object = $this->_model->getNewTopList();
        $_object = Tool::subStr($_object,'title',14,'utf-8');
        if ($_object) {
            $i = 1;
            foreach ($_object as $_value) {
                if ($i % 2 == 0) {
                    $_value->line = '';
                } else {
                    $_value->line = '|';
                }
                $i++;
            }
        }
        $this->_tpl->assign('NewTopList', $_object);

        $_new = new NavModel();
        $_object = $_new->getFourNav();
        if ($_object) {
            $i = 1;
            foreach ($_object as $_value) {
                if ($i % 2 == 0) {
                    $_value->class = 'right';
                } else {
                    $_value->class = '';
                }
                $i++;
                // 获取文档
                $this->_model->nav = $_value->id;
                $_navList = $this->_model->getNewNavList();
                $_navList = Tool::subStr($_navList,'title',20,'utf-8');
                Tool::objDate($_navList,'date');
                $_value->list = $_navList;
            }
        }
        $this->_tpl->assign('FourNav',$_object);
    }
}
