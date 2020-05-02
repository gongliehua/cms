<?php

// 控制器
class ContentAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new ContentModel();
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
       $this->_tpl->assign('show', true);
       $this->_tpl->assign('add', false);
       $this->_tpl->assign('update', false);
       $this->_tpl->assign('title', '文档列表');
    }

    // 添加
    private function add()
    {
       $this->_tpl->assign('show', false);
       $this->_tpl->assign('add', true);
       $this->_tpl->assign('update', false);
       $this->_tpl->assign('title', '新增文档');
       $_nav = new NavModel();
       $_html = '';
       foreach ($_nav->getAllFrontNav() as $_object) {
            $_html .= '<optgroup label="'.$_object->nav_name.'">';
            $_nav->id = $_object->id;
            // 获取子导航
            if (($_childNav = $_nav->getAllChildFrontNav())) {
                foreach ($_childNav as $_object) {
                    $_html .= '<option>'.$_object->nav_name.'</option>';
                }
            }
            $_html .= '</optgroup>';
       }
       $this->_tpl->assign('nav',$_html);
    }

    // 修改
    private function update()
    {
       
    }

    // 删除
    private function delete()
    {
       
    }
}
