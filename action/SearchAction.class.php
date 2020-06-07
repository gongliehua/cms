<?php

// 控制器
class SearchAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $model = new ContentModel();
        parent::__construct($_tpl, $model);
    }

    //执行
    public function _action() {
        $this->sidebar();
        $this->searchTitle();
        $this->searchKeyword();
        $this->searchTag();
    }

    // 侧边栏
    private function sidebar()
    {
        $this->_tpl->assign('MonthNavPic',[]);
        $this->_tpl->assign('MonthNavHot',[]);
        $this->_tpl->assign('MonthNavRec',[]);
    }

    // 安装标题搜索
    private function searchTitle()
    {
        if ($_GET['type'] == 1) {
            if (empty($_GET['inputkeyword'])) Tool::alertBack('搜索内容不能为空！');

            $this->_model->inputkeyword = $_GET['inputkeyword'];
            parent::page($this->_model->searchTitleTotal());
            
            $_object = $this->_model->searchTitle();

            $_object = Tool::subStr($_object,'info',120,'utf-8');
            $_object = Tool::subStr($_object,'title',30,'utf-8');
            if ($_object) {
                foreach ($_object as $_value) {
                    if (empty($_value->thumbnail)) {
                        $_value->thumbnail = 'images/none.jpg';
                    }
                    $_value->t = str_replace($_GET['inputkeyword'], '<span class="red">'.$_GET['inputkeyword'].'</span>', $_value->t);
                }
            }
            $this->_tpl->assign('SearchContent',$_object);
        }
    }

    // 安装关键字搜索
    private function searchKeyword()
    {
        if ($_GET['type'] == 2) {
            if (empty($_GET['inputkeyword'])) Tool::alertBack('搜索内容不能为空！');

            $this->_model->inputkeyword = $_GET['inputkeyword'];
            parent::page($this->_model->searchKeywordTotal());
            
            $_object = $this->_model->searchKeyword();

            $_object = Tool::subStr($_object,'info',120,'utf-8');
            $_object = Tool::subStr($_object,'title',30,'utf-8');
            if ($_object) {
                foreach ($_object as $_value) {
                    if (empty($_value->thumbnail)) {
                        $_value->thumbnail = 'images/none.jpg';
                    }
                }
            }
            $this->_tpl->assign('SearchContent',$_object);
        }
    }

    // 安装tag标签搜索
    private function searchTag()
    {
        if ($_GET['type'] == 3) {
            if (empty($_GET['inputkeyword'])) Tool::alertBack('搜索内容不能为空！');

            $this->_model->inputkeyword = $_GET['inputkeyword'];
            parent::page($this->_model->searchTagTotal());
            
            $_object = $this->_model->searchTag();

            $_object = Tool::subStr($_object,'info',120,'utf-8');
            $_object = Tool::subStr($_object,'title',30,'utf-8');
            if ($_object) {
                foreach ($_object as $_value) {
                    if (empty($_value->thumbnail)) {
                        $_value->thumbnail = 'images/none.jpg';
                    }
                }
            }

            // 添加Tag
            $_tag = new TagModel();
            $_tag->tagname = $_GET['inputkeyword'];
            if ($_tag->getOneTag()) {
                $_tag->addTagCount();
            } else {
                $_tag->addTag();
            }

            $this->_tpl->assign('SearchContent',$_object);
        }
    }
}
