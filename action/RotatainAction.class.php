<?php

// 控制器
class RotatainAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new RotatainModel();
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
            case 'update':
                $this->update();
                break;
            case 'state':
                $this->state();
                break;
            case 'delete':
                $this->delete();
                break;
            case 'xml':
                $this->xml();
                break;
            default:
                Tool::alertBack('非法操作！');
        }
    }

    // 列表
    private function show()
    {
        parent::page($this->_model->getRotatainTotal());
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('add',false);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','轮播器列表');
        $_object = $this->_model->getAllRotatain();
        $_object = Tool::subStr($_object,'link',20,'utf-8');
        foreach ($_object as $key => $_value) {
            if (empty($_value->state)) {
                $_value->state = '<span class="red">[否]</span> | <a href="rotatain.php?action=state&type=ok&id='.$_value->id.'">确定</a>';
            } else {
                $_value->state = '<span class="green">[是]</span>  | <a href="rotatain.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
            }
        }
        $this->_tpl->assign('AllRotatain',$_object);
    }

    // state单词审核
    private function state() {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            if (!$this->_model->getOneRotatain()) {
                Tool::alertBack('警告：不存在此轮播器！');
            }
            if ($_GET['type'] == 'ok') {
                if ($this->_model->setStateOk()) {
                    Tool::alertLocation(null,'rotatain.php?action=show');
                } else {
                    Tool::alertBack('警告：确认失败！');
                }
            } elseif ($_GET['type'] == 'cancel') {
                if ($this->_model->setStateCancel()) {
                    Tool::alertLocation(null,'rotatain.php?action=show');
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

    // 添加
    private function add()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['thumbnail'])) Tool::alertBack('警告：轮播图不得为空');
            if (Validate::checkNull($_POST['link'])) Tool::alertBack('警告：链接不得为空');
            if (Validate::checkLength($_POST['title'],20,'max')) Tool::alertBack('警告：标题不得大于20位');
            if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：简介不得大于200位');
            $this->_model->thumbnail = $_POST['thumbnail'];
            $this->_model->title = $_POST['title'];
            $this->_model->info = $_POST['info'];
            $this->_model->link = $_POST['link'];
            $this->_model->addRotatain() ? Tool::alertLocation('恭喜你，新增轮播器成功！','rotatain.php?action=show') : Tool::alertBack('很遗憾，新增轮播器失败！');
        }
        $this->_tpl->assign('show',false);
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','新增轮播器');
    }

    // xml
    private function xml()
    {
        $_object = $this->_model->getNewRotatain();
        $_xml = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
        $_xml .= '<bcaster autoPlayTime="'.RO_TIME.'">' . "\n";
        if ($_object) {
            foreach ($_object as $_value) {
                $_xml .= '<item item_url="'.$_value->thumbnail.'" link="'.$_value->link.'" itemtitle="'.$_value->title.'"/>' . "\n";
            }
        }
        $_xml .= '</bcaster>';
        $_sxe = new SimpleXMLElement($_xml);
        $_sxe->asXML('../bcastr.xml');
        Tool::alertLocation('恭喜，生成录播xml文件成功！','?action=show');
    }

    // 修改
    private function update()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['thumbnail'])) Tool::alertBack('警告：轮播图不得为空');
            if (Validate::checkNull($_POST['link'])) Tool::alertBack('警告：链接不得为空');
            if (Validate::checkLength($_POST['title'],20,'max')) Tool::alertBack('警告：标题不得大于20位');
            if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：简介不得大于200位');
            $this->_model->id = $_POST['id'];
            $this->_model->thumbnail = $_POST['thumbnail'];
            $this->_model->title = $_POST['title'];
            $this->_model->link = $_POST['link'];
            $this->_model->info = $_POST['info'];
            $this->_model->state = $_POST['state'];
            $this->_model->updateRotatain() ? Tool::alertLocation('恭喜你，修改轮播成功！','rotatain.php?action=show') : Tool::alertBack('很遗憾，修改轮播失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_rotatain = $this->_model->getOneRotatain();
            if (!$_rotatain) Tool::alertBack('警告：不存在此轮播！');
            $this->_tpl->assign('id',$_rotatain->id);
            $this->_tpl->assign('titlec',$_rotatain->title);
            $this->_tpl->assign('thumbnail',$_rotatain->thumbnail);
            $this->_tpl->assign('info',$_rotatain->info);
            $this->_tpl->assign('link',$_rotatain->link);
            if (empty($_rotatain->state)) {
                $this->_tpl->assign('left_state','');
                $this->_tpl->assign('right_state','checked');
            } else {
                $this->_tpl->assign("left_state",'checked');
                $this->_tpl->assign("right_state",'');
            }
            $this->_tpl->assign('show',false);
            $this->_tpl->assign('add',false);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('title','修改轮播器');
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // 删除
    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $this->_model->deleteRotatain() ? Tool::alertLocation('恭喜你，删除轮播成功！','rotatain.php?action=show') : Tool::alertBack('很遗憾，删除轮播失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
    }
}
