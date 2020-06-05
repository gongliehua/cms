<?php

// 控制器
class VoteAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new VoteModel();
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
            case 'add':
                $this->add();
                break;
            case 'addchild':
                $this->addchild();
                break;
            case 'showchild':
                $this->showchild();
                break;
            case 'update':
                $this->update();
                break;
            case 'state':
                $this->state();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                Tool::alertBack('非法操作！');
        }
    }

    private function _module()
    {
        $this->_tpl->assign('show',false);
        $this->_tpl->assign('add',false);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('addchild',false);
        $this->_tpl->assign('showchild',false);
    }

    // 列表
    private function show()
    {
        parent::page($this->_model->getVoteToTal());
        $this->_module();
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('title','投票主题列表');
        $_object = $this->_model->getAllVote();
        foreach ($_object as $_value) {
            if (empty($_value->state)) {
                $_value->state = '<span class="red">[否]</span> | <a href="vote.php?action=state&type=ok&id='.$_value->id.'">首选</a>';
            } else {
                $_value->state = '<span class="green">[是]</span> | <a href="javascript:;">确认</a>';
            }
        }
        $this->_tpl->assign('AllVote',$_object);
    }

    // state单词审核
    private function state() {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            if (!$this->_model->getOneVote()) {
                Tool::alertBack('警告：不存在此投票！');
            }
            if ($_GET['type'] == 'ok') {
                $this->_model->setStateCancel();
                if ($this->_model->setStateOk()) {
                    Tool::alertLocation(null,'vote.php?action=show');
                } else {
                    Tool::alertBack('警告：首选失败！');
                }
            } else {
                Tool::alertBack('警告：非常操作！');
            }
        } else {
            Tool::alertBack('警告：非常操作！');
        }
    }

    // 列表,项目
    private function showchild()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_vote = $this->_model->getOneVote();
            if (!$_vote) Tool::alertBack('警告：不存在次主题！');

            parent::page($this->_model->getChildVoteToTal());
            $this->_module();
            $this->_tpl->assign('showchild',true);
            $this->_tpl->assign('title','投票项目列表');
            $this->_tpl->assign('id',$_GET['id']);
            $this->_tpl->assign('titlec',$_vote->title);
            $_object = $this->_model->getAllChildVote();
            $this->_tpl->assign('AllChildVote',$_object);
        } else {
            Tool::alertBack('警告：非法操作！');
        }
    }

    // 添加
    private function add()
    {
        if (isset($_POST['send'])) {
            $this->setAdd();
            $this->_model->vid = 0;
            $this->_model->addVote() ? Tool::alertLocation('恭喜你，新增投票主题成功！','vote.php?action=show') : Tool::alertBack('很遗憾，新增投票主题失败！');
        }
        $this->_module();
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('title','新增投票主题');
    }

    // 添加项目
    private function addchild()
    {
        if (isset($_POST['send'])) {
            $this->_model->vid = $_POST['id'];
            $this->setAdd();
            $this->_model->addVote() ? Tool::alertLocation('恭喜你，新增投票项目成功！','vote.php?action=show') : Tool::alertBack('很遗憾，新增投票项目失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_vote = $this->_model->getOneVote();
            if (!$_vote) Tool::alertBack('警告：不存在次主题！');
            $this->_module();
            $this->_tpl->assign('addchild',true);
            $this->_tpl->assign('title','新增投票项目');
            $this->_tpl->assign('id',$_GET['id']);
            $this->_tpl->assign('titlec',$_vote->title);
        } else {
            Tool::alertBack('警告：非法操作！');
        }
    }

    // setAdd
    private function setAdd() {
        if (Validate::checkNull($_POST['title'])) Tool::alertBack('警告：标题不得为空');
        if (Validate::checkLength($_POST['title'],2,'min')) Tool::alertBack('警告：标题不得小于2位');
        if (Validate::checkLength($_POST['title'],20,'max')) Tool::alertBack('警告：标题不得大于20位');
        if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：描述不得大于200位');
        $this->_model->title = $_POST['title'];
        $this->_model->info = $_POST['info'];
    }

    // 修改
    private function update()
    {
        if (isset($_POST['send'])) {
            $this->_model->id = $_POST['id'];
            $this->setAdd();
            $this->_model->updateVote() ? Tool::alertLocation('恭喜你，修改投票成功！','vote.php?action=show') : Tool::alertBack('很遗憾，修改投票失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_vote = $this->_model->getOneVote();
            if (!$_vote) Tool::alertBack('警告：该信息不存在！');
            $this->_tpl->assign('id',$_vote->id);
            $this->_tpl->assign('titlec',$_vote->title);
            $this->_tpl->assign('info',$_vote->info);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('title','修改投票主题');
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // 删除
    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $this->_model->deleteVote() ? Tool::alertLocation('恭喜你，删除投票成功！','vote.php?action=show') : Tool::alertBack('很遗憾，删除投票失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
    }
}
