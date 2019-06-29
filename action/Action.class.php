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
}
