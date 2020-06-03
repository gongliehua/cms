<?php

// 控制器
class ListAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl);
    }

    //执行
    public function _action() {
        $this->getNav();
        $this->getListContent();
    }

    // 获取前台列表显示
    private function getListContent()
    {
        if (isset($_GET['id'])) {
            $_model = new ContentModel();
            parent::__construct($this->_tpl, $_model);

            $_nav = new NavModel();
            $_nav->id = $_GET['id'];
            
            // 获取ID
            $_navId = $_nav->getNavChildId();
            if ($_navId) {
                $this->_model->nav = Tool::objArrOfStr($_navId,'id');
            } else {
                $this->_model->nav = $_nav->id;
            }

            parent::page($this->_model->getListContentTotal(),ARTICLE_SIZE);

            //列表
            $_object = $this->_model->getListContent();
            $_object = Tool::subStr($_object,'info',120,'utf-8');
            $_object = Tool::subStr($_object,'title',30,'utf-8');//35
            /*
            if (IS_CACHE) {
                if ($_object) {
                    foreach ($_object as $_value) {
                        $_value->count = "<script type='text/javascript'>getContentCount();</script>";
                    }
                }
            }*/
            if ($_object) {
                foreach ($_object as $_value) {
                    if (empty($_value->thumbnail)) {
                        $_value->thumbnail = 'images/none.jpg';
                    }
                }
            }
            $this->_tpl->assign('AllListContent',$_object);

            // 本月排行榜
            $_object = $this->_model->getMonthNavRec();
            $this->setObject($_object);
            $this->_tpl->assign('MonthNavRec',$_object);
            // 本月热点
            $_object = $this->_model->getMonthNavHot();
            $this->setObject($_object);
            $this->_tpl->assign('MonthNavHot',$_object);
            // 本月图文
            $_object = $this->_model->getMonthNavPic();
            $this->setObject($_object);
            $this->_tpl->assign('MonthNavPic',$_object);
        } else {
            Tool::alertBack('警告：非法操作！');
        }
    }

    //setObject
    private function setObject(&$_object)
    {
        if ($_object) {
            $_object = Tool::subStr($_object,'title',15,'utf-8');
            Tool::objDate($_object,'date');
        }
    }

    // 获取前台显示导航
    private function getNav()
    {
        if (isset($_GET['id'])) {
            $_nav = new NavModel();
            $_nav->id = $_GET['id'];
            if ($_result = $_nav->getOneNav()) {
                // 主导航
                if ($_result->iid) {
                    $_nav1 = '<a href="/list.php?id='. $_result->iid.'">'.$_result->nnav_name.'</a> &gt; ';
                } else {
                    $_nav1 = '';
                }
                $_nav2 = '<a href="/list.php?id='.$_result->id.'">'.$_result->nav_name.'</a>';
                $this->_tpl->assign('nav', $_nav1.$_nav2);
                // 子导航
                $this->_tpl->assign('childNav', $_nav->getAllChildFrontNav());
            } else {
                Tool::alertBack('警告: 此导航不存在!');
            }
        } else {
            Tool::alertBack('警告: 非法操作!');
        }
    }
}
