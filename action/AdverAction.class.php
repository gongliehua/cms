<?php

// 控制器
class AdverAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new AdverModel();
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
            case 'delete':
                $this->delete();
                break;
            case 'state':
                $this->state();
                break;
            case 'text':
                $this->text();
                break;
            case 'header':
                $this->header();
                break;
            case 'sidebar':
                $this->sidebar();
                break;
            default:
                Tool::alertBack('非法操作！');
        }
    }

    // 列表
    private function show()
    {
        parent::page($this->_model->getAdverTotal());
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('add',false);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','广告列表');
        $_object = $this->_model->getAllAdver();
        $_object = Tool::subStr($_object, 'link', 20, 'utf-8');
        if ($_object) {
            foreach ($_object as $_value) {
                switch ($_value->type) {
                    case 1:
                        $_value->type = '文字广告';
                        break;
                    case 2:
                        $_value->type = '头部广告(690x80)';
                        break;
                    case 3:
                        $_value->type = '侧栏广告(270x200)';
                        break;
                }
                if (empty($_value->state)) {
                    $_value->state = '<span class="red">[否]</span> | <a href="adver.php?action=state&type=ok&id='.$_value->id.'">确定</a>';
                } else {
                    $_value->state = '<span class="green">[是]</span>  | <a href="adver.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
                }
            }
        }
        $this->_tpl->assign("AllAdver", $_object);
    }

    // state
    private function state() {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            if (!$this->_model->getOneAdver()) {
                Tool::alertBack('警告：不存在此广告！');
            }
            if ($_GET['type'] == 'ok') {
                if ($this->_model->setStateOk()) {
                    Tool::alertLocation(null,'adver.php?action=show');
                } else {
                    Tool::alertBack('警告：确认失败！');
                }
            } elseif ($_GET['type'] == 'cancel') {
                if ($this->_model->setStateCancel()) {
                    Tool::alertLocation(null,'adver.php?action=show');
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
            $this->_model->type = $_POST['type'];
            if (Validate::checkNull($_POST['title'])) Tool::alertBack('警告：标题不得为空');
            if (Validate::checkLength($_POST['title'],20,'max')) Tool::alertBack('警告：标题不得大于20位');
            if (Validate::checkNull($_POST['link'])) Tool::alertBack('警告：链接不得为空');
            if (in_array($this->_model->type, [2,3])) {
                if (Validate::checkNull($_POST['thumbnail'])) Tool::alertBack('警告：广告不得为空');
            }
            if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：描述不得大于200位');
            $this->_model->title = $_POST['title'];
            $this->_model->link = $_POST['link'];
            $this->_model->thumbnail = $_POST['thumbnail'];
            $this->_model->info = $_POST['info'];
            $this->_model->addAdver() ? Tool::alertLocation('恭喜你，新增广告成功！','adver.php?action=show') : Tool::alertBack('很遗憾，新增广告失败！');
        }
        $this->_tpl->assign('show',false);
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','新增广告');
    }

    // 修改
    private function update()
    {
        if (isset($_POST['send'])) {
            $this->_model->id = $_POST['id'];
            if (!$this->_model->getOneAdver()) Tool::alertBack('警告：该信息不存在，建议刷新页面后重试！');
            if (Validate::checkNull($_POST['title'])) Tool::alertBack('警告：标题不得为空');
            if (Validate::checkLength($_POST['title'],20,'max')) Tool::alertBack('警告：标题不得大于20位');
            if (Validate::checkNull($_POST['link'])) Tool::alertBack('警告：链接不得为空');
            $this->_model->type = $_POST['type'];
            if (in_array($this->_model->type, [2,3])) {
                if (Validate::checkNull($_POST['thumbnail'])) Tool::alertBack('警告：广告不得为空');
            }
            if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：描述不得大于200位');
            $this->_model->title = $_POST['title'];
            $this->_model->link = $_POST['link'];
            $this->_model->thumbnail = $_POST['thumbnail'];
            $this->_model->info = $_POST['info'];
            $this->_model->state = $_POST['state'];
            $this->_model->updateAdver() ? Tool::alertLocation('恭喜你，修改广告成功！','adver.php?action=show') : Tool::alertBack('很遗憾，修改广告失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_adver = $this->_model->getOneAdver();
            if (!$_adver) Tool::alertBack('警告：不存在次广告！');
            $this->_tpl->assign('id',$_adver->id);
            $this->_tpl->assign('titlec',$_adver->title);
            $this->_tpl->assign('thumbnail',$_adver->thumbnail);
            $this->_tpl->assign('link',$_adver->link);
            $this->_tpl->assign('info',$_adver->info);
            // 图片处理
            switch ($_adver->type) {
                case 1:
                    $this->_tpl->assign("typeText", 'checked');
                    $this->_tpl->assign("typeHeader", '');
                    $this->_tpl->assign("typeSidebar", '');
                    $this->_tpl->assign("picShow", 'display: none;');
                    $this->_tpl->assign("picText", '');
                    break;
                case 2:
                    $this->_tpl->assign("typeText", '');
                    $this->_tpl->assign("typeHeader", 'checked');
                    $this->_tpl->assign("typeSidebar", '');
                    $this->_tpl->assign("picShow", 'display: block;');
                    $this->_tpl->assign("picText", "<input type=\"button\" value=\"上传头部广告\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=690x80','upfile','600','180')\">");
                    break;
                case 3:
                    $this->_tpl->assign("typeText", '');
                    $this->_tpl->assign("typeHeader", '');
                    $this->_tpl->assign("typeSidebar", 'checked');
                    $this->_tpl->assign("picShow", 'display: block;');
                    $this->_tpl->assign("picText", "<input type=\"button\" value=\"上传侧栏广告\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=270x200','upfile','600','180')\">");
                    break;
            }
            // 是否前台广告处理(前台显示)
            if (empty($_adver->state)) {
                $this->_tpl->assign('stateShow','');
                $this->_tpl->assign('stateHide','checked');
            } else {
                $this->_tpl->assign('stateShow','checked');
                $this->_tpl->assign('stateHide','');
            }

            $this->_tpl->assign('show',false);
            $this->_tpl->assign('add',false);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('title','修改广告');
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // 文字广告
    private function text()
    {
        $_object = $this->_model->getNewTextAdver();

        $_js = "";
        if ($_object) {
            $_js = "var text = [];\n";
            $_i = 0;
            foreach ($_object as $_value) {
                $_js .= "text[$_i]={\n";
                $_js .= "\t'title': '$_value->title',\n";
                $_js .= "\t'link': '$_value->link'\n";
                $_js .= "};\n";
                $_i++;
            }
            $_js .= "var i = Math.ceil(Math.random()*10) % $_i;\n";
            $_js .= "document.write('<a class=\"adv\" href=\"'+text[i].link+'\" target=\"_blank\">'+text[i].title+'</a>');\n";
        }

        file_put_contents('../js/text_adver.js', $_js);
        Tool::alertLocation('生成js文件成功','?action=show');
    }

    // 头部广告
    private function header()
    {
        $_object = $this->_model->getNewHeaderAdver();

        $_js = "";
        if ($_object) {
            $_js = "var header = [];\n";
            $_i = 0;
            foreach ($_object as $_value) {
                $_js .= "header[$_i]={\n";
                $_js .= "\t'title': '$_value->title',\n";
                $_js .= "\t'pic': '$_value->thumbnail',\n";
                $_js .= "\t'link': '$_value->link'\n";
                $_js .= "};\n";
                $_i++;
            }
            $_js .= "var i = Math.ceil(Math.random()*10) % $_i;\n";
            $_js .= "document.write('<a href=\"'+header[i].link+'\" title=\"'+header[i].title+'\" target=\"_blank\"><img src=\"'+header[i].pic+'\" style=\"border: none;\"></a>');\n";
        }

        file_put_contents('../js/header_adver.js', $_js);
        Tool::alertLocation('生成js文件成功','?action=show');
    }

    // 侧栏广告
    private function sidebar()
    {
        $_object = $this->_model->getNewSidebarAdver();

        $_js = "";
        if ($_object) {
            $_js = "var sidebar = [];\n";
            $_i = 0;
            foreach ($_object as $_value) {
                $_js .= "sidebar[$_i]={\n";
                $_js .= "\t'title': '$_value->title',\n";
                $_js .= "\t'pic': '$_value->thumbnail',\n";
                $_js .= "\t'link': '$_value->link'\n";
                $_js .= "};\n";
                $_i++;
            }
            $_js .= "var i = Math.ceil(Math.random()*10) % $_i;\n";
            $_js .= "document.write('<a href=\"'+sidebar[i].link+'\" title=\"'+sidebar[i].title+'\" target=\"_blank\"><img src=\"'+sidebar[i].pic+'\" style=\"border: none;\"></a>');\n";
        }

        file_put_contents('../js/sidebar_adver.js', $_js);
        Tool::alertLocation('生成js文件成功','?action=show');
    }

    // 删除
    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $this->_model->deleteAdver() ? Tool::alertLocation('恭喜你，删除广告成功！','adver.php?action=show') : Tool::alertBack('很遗憾，删除广告失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
    }
}
