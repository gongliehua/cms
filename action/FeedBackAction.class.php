<?php

// 控制器
class FeedBackAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl);
    }

    // 流程控制器
    public function _action()
    {
        $this->addComment();
        $this->setCount();
        $this->showComment();
    }

    // 新增评论
    private function addComment()
    {
        if (isset($_POST['send'])) {
            if (isset($_GET['current'])) {
                if (Validate::checkNull($_POST['content'])) Tool::alertBack('警告：评论内容不得为空');
                if (Validate::checkLength($_POST['content'],255,'max')) Tool::alertBack('警告：评论内容不得大于255位');
                if (Validate::checkLength($_POST['code'],4,'equals')) Tool::alertBack('警告：验证码是4位');
                if (Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertBack('警告：验证码不正确');
            } else {
                if (Validate::checkNull($_POST['content'])) Tool::alertClose('警告：评论内容不得为空');
                if (Validate::checkLength($_POST['content'],255,'max')) Tool::alertClose('警告：评论内容不得大于255位');
                if (Validate::checkLength($_POST['code'],4,'equals')) Tool::alertClose('警告：验证码是4位');
                if (Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertClose('警告：验证码不正确');
            }
            $model = new CommentModel();
            parent::__construct($this->_tpl, $model);
            $_cookie = new Cookie('user');
            if ($user = $_cookie->getCookie()) {
                $this->_model->user = $user;
            } else {
                $this->_model->user = '游客';
            }
            $this->_model->manner = $_POST['manner'];
            $this->_model->content = $_POST['content'];
            $this->_model->cid = $_GET['cid'];
            if ($this->_model->addComment()) {
                Tool::alertLocation('评论成功，请等待管理员审核！','feedback.php?cid='.$this->_model->cid);
            } else {
                Tool::alertLocation('评论失败，请重新评论!','feedback.php?cid='.$this->_model->cid);
            }
        }
    }

    // 显示评论
    private function showComment() {
        if (isset($_GET['cid'])) {
            $model = new CommentModel();
            parent::__construct($this->_tpl, $model);
            $this->_model->cid = $_GET['cid'];
            $_content = new ContentModel();
            $_content->id = $_GET['cid'];
            if (!$_content->getOneContent()) {
                Tool::alertBack('警告：不存在文档的评论');
            }
            parent::page($this->_model->getCommentTotal());
            $_object = $this->_model->getAllComment();
            $_object2 = $this->_model->getHotThreeComment();
            $_object3 = $_content->getHotTwentyComment();
            $this->setObject($_object);
            $this->setObject($_object2);
            $_content->id = $this->_model->cid;
            $info = $_content->getOneContent();
            $this->_tpl->assign('id', $info->id);
            $this->_tpl->assign('titlec', $info->title);
            $this->_tpl->assign('info', $info->info);
            $this->_tpl->assign('cid', $this->_model->cid);
            $this->_tpl->assign('AllComment', $_object);
            $this->_tpl->assign('HotThreeComment', $_object2);
            $this->_tpl->assign('HotTwentyComment', $_object3);
        } else {
            Tool::alertBack('警告：非法操作！');
        }
    }

    //支持反对
    private function setCount()
    {
        if (isset($_GET['cid']) && isset($_GET['id']) && isset($_GET['type'])) {
            $model = new CommentModel();
            parent::__construct($this->_tpl, $model);

            $this->_model->id = $_GET['id'];
            if (!$this->_model->getOneComment()) {
                Tool::alertBack('警告：不存在此评论');
            }

            if ($_GET['type'] == 'sustain') {
                if ($this->_model->setSustain()) {
                    Tool::alertLocation('支持成功','feedback.php?cid='.$_GET['cid']);
                } else {
                    Tool::alertLocation('支持失败','feedback.php?cid='.$_GET['cid']);
                }
            }
            if ($_GET['type'] == 'oppose') {
                if ($this->_model->setOppose()) {
                    Tool::alertLocation('反对成功','feedback.php?cid='.$_GET['cid']);
                } else {
                    Tool::alertLocation('反对失败','feedback.php?cid='.$_GET['cid']);
                }
            }
        }
    }

    // 转换
    private function setObject(&$_object)
    {
        if ($_object) {
            foreach ($_object as $_value) {
                switch ($_value->manner) {
                    case -1:
                        $_value->manner = '反对';
                        break;
                    case 0:
                        $_value->manner = '中立';
                        break;
                    case 1:
                        $_value->manner = '支持';
                        break;
                    default:
                        # code...
                        break;
                }
                if (empty($_value->face)) {
                    $_value->face = '00.gif';
                }
                if (!empty($_value->oppose)) {
                    $_value->oppose = '-'.$_value->oppose;
                }
            }
        }
    }
}
