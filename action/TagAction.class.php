<?php

// 控制器
class TagAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new TagModel();
        parent::__construct($_tpl, $_model);
    }

    // 流程控制器
    public function _action()
    {
        
    }

    public function getTopFiveTag()
    {
        $this->_tpl->assign('TopFiveTag', $this->_model->getTopFiveTag());
    }
}
