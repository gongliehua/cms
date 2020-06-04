<?php

// 控制器
class CommentAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new CommentModel();
        parent::__construct($_tpl, $_model);
    }

    // 流程控制器
    public function _action()
    {
        // 业务流程控制器
        $_GET['action'] = isset($_GET['action']) ? $_GET['action'] : 'show';
        switch ($_GET['action']) {
            case 'show':
                $this->show();
                break;
            case 'state':
                $this->state();
                break;
            case 'states':
                $this->states();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                Tool::alertBack('非法操作！');
        }
    }

    // 列表
    private function show()
    {
        parent::page($this->_model->getCommentListToTal());
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('title','评论列表');
        $_object = $this->_model->getCommentList();
        $_object = Tool::subStr($_object,'content',30,'utf-8');
        if ($_object) {
            foreach ($_object as $_value) {
                if (empty($_value->state)) {
                    $_value->state = '<span class="red">[未审核]</span> | <a href="comment.php?action=state&type=ok&id='.$_value->id.'">通过</a>';
                } else {
                    $_value->state = '<span class="red">[已审核]</span> | <a href="comment.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
                }
            }
        }
        $this->_tpl->assign('CommentList',$_object);
    }

    // state单次审核
    private function state() {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            if (!$this->_model->getOneComment()) {
                Tool::alertBack('警告：不存在此评论！');
            }
            if ($_GET['type'] == 'ok') {
                if ($this->_model->setStateOk()) {
                    Tool::alertLocation(null,'comment.php?action=show');
                } else {
                    Tool::alertBack('警告：审核失败！');
                }
            } elseif ($_GET['type'] == 'cancel') {
                if ($this->_model->setStateCancel()) {
                    Tool::alertLocation(null,'comment.php?action=show');
                } else {
                    Tool::alertBack('警告：取消失败！');
                }
            } else {
                Tool::alertBack('警告：非常操作！');
            }
        } else {
            Tool::alertBack('警告：非常操作！');
        }
    }

    // 批量审核
    public function states()
    {
        if (isset($_POST['send'])) {
            $this->_model->states = $_POST['states'];
            $this->_model->setStates();
        }
        Tool::alertLocation(null, 'comment.php?action=show');
    }

    // 删除
    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $this->_model->deleteComment() ? Tool::alertLocation('恭喜你，删除评论成功！','comment.php?action=show') : Tool::alertBack('很遗憾，删除评论失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
    }
}
