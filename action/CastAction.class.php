<?php

// 控制器
class CastAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $model = new VoteModel();
        parent::__construct($_tpl, $model);
    }

    //执行
    public function _action() {
        $this->setCount();
    }

    // 累计
    private function setCount()
    {
        if (isset($_POST['send'])) {
            if (empty($_POST['vote'])) {
                Tool::alertClose('警告：请选择投票！');
            }
            $this->_model->id = $_POST['vote'];
            $this->_model->setCount() ? Tool::alertLocation('恭喜，投票成功，感谢您的参与！', 'cast.php') : Tool::alertLocation(null,'cast.php');
        }
    }
}
