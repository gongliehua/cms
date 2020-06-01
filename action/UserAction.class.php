<?php

// 控制器
class UserAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new UserModel();
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
            default:
                Tool::alertBack('非法操作！');
        }
    }

    // 列表
    private function show()
    {
        parent::page($this->_model->getUserTotal());
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('add',false);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','会员列表');
        $_object = $this->_model->getAllUser();
        foreach ($_object as $_value) {
            switch ($_value->state) {
                case 0:
                    $_value->state = '被封杀的会员';
                    break;
                case 1:
                    $_value->state = '待审核的会员';
                    break;
                case 2:
                    $_value->state = '初级会员';
                    break;
                case 3:
                    $_value->state = '中级会员';
                    break;
                case 4:
                    $_value->state = '高级会员';
                    break;
                case 5:
                    $_value->state = 'VIP会员';
                    break;
                default:
                    # code...
                    break;
            }
        }
        $this->_tpl->assign('AllUser',$_object);
    }

    // 添加
    private function add()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['user'])) Tool::alertBack('警告：用户名不得为空');
            if (Validate::checkLength($_POST['user'],2,'min')) Tool::alertBack('警告：用户名不得小于2位');
            if (Validate::checkLength($_POST['user'],20,'max')) Tool::alertBack('警告：用户名不得大于20位');
            if (Validate::checkNull($_POST['pass'])) Tool::alertBack('警告：密码不得为空');
            if (Validate::checkLength($_POST['pass'],6,'min')) Tool::alertBack('警告：密码不得小于6位');
            if (Validate::checkEquals($_POST['pass'],$_POST['notpass'])) Tool::alertBack('警告：密码和确认密码不一致');
            if (Validate::checkNull($_POST['email'])) Tool::alertBack('警告：电子邮箱不得为空');
            if (Validate::checckEmail($_POST['email'])) Tool::alertBack('警告：电子邮箱格式不正确');
            if (!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['answer'])) {
                $this->_model->question = $_POST['question'];
                $this->_model->answer = $_POST['answer'];
            }
            $this->_model->user = $_POST['user'];
            $this->_model->pass = sha1($_POST['pass']);
            $this->_model->email = $_POST['email'];
            $this->_model->face = $_POST['face'];
            $this->_model->state = $_POST['state'];
            if ($this->_model->checkUser()) Tool::alertBack('警告：用户名重复！');
            if ($this->_model->checkEmail()) Tool::alertBack('警告：邮箱重复！');
            if ($this->_model->addUser()) {
                Tool::alertLocation('恭喜您注册成功','user.php?action=show');
            } else {
                Tool::alertBack("很遗憾，注册失败");
            }
        }
        $this->_tpl->assign('show',false);
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('update',false);
        $this->_tpl->assign('title','新增会员');
        $this->_tpl->assign('OptionFaceOne', range(1, 9));
        $this->_tpl->assign('OptionFaceTwo', range(10, 24));
    }

    // 修改
    private function update()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['pass'])) {
                $this->_model->pass = $_POST['pass'];
            } else {
                if (Validate::checkLength($_POST['pass'],6,'min')) Tool::alertBack('警告：密码不得小于6位');
                $this->_model->pass = sha1($_POST['pass']);
            }
            if (Validate::checkNull($_POST['email'])) Tool::alertBack('警告：电子邮箱不得为空');
            if (Validate::checckEmail($_POST['email'])) Tool::alertBack('警告：电子邮箱格式不正确');
            if (!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['answer'])) {
                $this->_model->question = $_POST['question'];
                $this->_model->answer = $_POST['answer'];
            }
            $this->_model->id = $_POST['id'];
            $this->_model->email = $_POST['email'];
            $this->_model->face = $_POST['face'];
            $this->_model->state = $_POST['state'];
            $this->_model->updateUser() ? Tool::alertLocation('恭喜你，修改会员成功！','user.php?action=show') : Tool::alertBack('很遗憾，修改会员失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_user = $this->_model->getOneUser();
            is_object($_user) ? true : Tool::alertBack('会员传值的ID有误！');

            $this->_tpl->assign('id',$_user->id);
            $this->_tpl->assign('user',$_user->user);
            $this->_tpl->assign('pass',$_user->pass);
            $this->_tpl->assign('facesrc',$_user->face);
            $this->_tpl->assign('email',$_user->email);
            $this->_tpl->assign('answer',$_user->answer);
            $this->question($_user->question);
            $this->face($_user->face);
            $this->state($_user->state);

            $this->_tpl->assign('show',false);
            $this->_tpl->assign('add',false);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('title','修改会员');

            $this->_tpl->assign('OptionFaceOne', range(1, 9));
            $this->_tpl->assign('OptionFaceTwo', range(10, 24));
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // 删除
    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $this->_model->deleteUser() ? Tool::alertLocation('恭喜你，删除会员成功！','user.php?action=show') : Tool::alertBack('很遗憾，删除会员失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // 状态
    private function state($_state)
    {
        $_stateArr = ['被封杀的会员','待审核的会员','初级会员','中级会员','高级会员','VIP会员'];
        $_html = '';
        foreach ($_stateArr as $_key=>$_value) {
            $_selected = ($_state == $_key) ? 'checked' : '';
            $_html .= '<input type="radio" name="state" value="'.$_key.'" '.$_selected.' />'.$_value;
        }
        $this->_tpl->assign('state',$_html);
    }

    // 问题
    private function question($_question) {
        $_questionArr = ['您父亲的姓名？','您母亲的职业？','您配偶的性别？'];
        $_html = '';
        foreach ($_questionArr as $_value) {
            $_selected = ($_quesiton == $_value) ? 'selected' : '';
            $_html .= '<option value="'.$_value.'" '.$_selected.'>'.$_value.'</option>';
        }
        $this->_tpl->assign('question',$_html);
    }

    // 头像
    private function face($_face) {
        $_one = range(1, 9);
        $_two = range(10, 24);
        $_html = '';
        foreach ($_one as $_value) {
            $_selected = ('0'.$_value.'.gif' == $_face) ? 'selected' : '';
            $_html .= '<option value="0'.$_value.'.gif" '.$_selected.'>0'.$_value.'.gif</option>';
        }
        foreach ($_two as $_value) {
            $_selected = ($_value.'.gif' == $_face) ? 'selected' : '';
            $_html .= '<option value="'.$_value.'.gif" '.$_selected.'>'.$_value.'.gif</option>';
        }
        $this->_tpl->assign('face',$_html);
    }
}
