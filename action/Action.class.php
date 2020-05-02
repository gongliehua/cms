<?php

// 控制器基类
class Action {
    protected $_tpl;
    protected $_model;

    // 初始化
    protected function __construct(&$_tpl,&$_model = null)
    {
        $this->_tpl = $_tpl;
        $this->_model = $_model;
    }

    protected function page($_total,$_pageSize = PAGE_SIZE) {
    	$_page = new Page($_total,$_pageSize);
    	$this->_model->limit = $_page->limit;
    	$this->_tpl->assign('page',$_page->showPage());
    	$this->_tpl->assign('num',($_page->page -1 ) * $_pageSize);
    }
}
