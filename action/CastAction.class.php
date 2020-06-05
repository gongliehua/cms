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
        $this->getVote();
    }

    // 获取投票
    private function getVote() {
        $_vote = new VoteModel();
        $_sum = $_vote->getVoteSum()->c;
        $_object = $_vote->getVoteItem();
        if ($_object) {
            $_i = 1;
            foreach ($_object as $_value) {
                $_value->percent = round(($_value->count / $_sum) * 100, 2);
                $_value->picwidth = ($_value->count / $_sum) * 100;
                $_value->picnum = $_i;
                $_i++;
            }
        }
        $this->_tpl->assign('vote_title', $_vote->getVoteTitleOne()->title);
        $this->_tpl->assign('vote_item', $_object);
    }

    // 累计
    private function setCount()
    {
        if (isset($_POST['send'])) {
            if (empty($_POST['vote'])) {
                Tool::alertClose('警告：请选择投票！');
            }
            $this->_model->id = $_POST['vote'];
            // 简单处理，一天之内投票一次
            if (isset($_COOKIE['ip']) && isset($_COOKIE['time'])) {
                if ((time() - $_COOKIE['time']) < (60 * 60 * 24)) {
                    Tool::alertLocation('您已经参与了本次投票，请不要重复投票！', 'cast.php');
                }
            };
            setcookie('ip', $_SERVER['REMOTE_ADDR']);
            setcookie('time', time());
            $this->_model->setCount() ? Tool::alertLocation('恭喜，投票成功，感谢您的参与！', 'cast.php') : Tool::alertLocation(null,'cast.php');
        }
    }
}
