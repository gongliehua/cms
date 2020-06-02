<?php

// 控制器
class DetailsAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl);
    }

    //执行
    public function _action() {
        $this->getDetails();
    }

    //获取文档详细内容
    private function getDetails() {
        if (isset($_GET['id'])) {
            $_model = new ContentModel();
            parent::__construct($this->_tpl,$_model);
            $this->_model->id = $_GET['id'];
            if (!$this->_model->setContentCount()) Tool::alertBack('警告：不存在此文档');
            $_content = $this->_model->getOneContent();
            $_comment = new CommentModel();
            $_comment->cid = $this->_model->id;
            $this->_tpl->assign('id',$_content->id);
            $this->_tpl->assign('titlec',$_content->title);
            $this->_tpl->assign('date',$_content->date);
            $this->_tpl->assign('source',$_content->source);
            $this->_tpl->assign('author',$_content->author);
            $this->_tpl->assign('info',$_content->info);
            $this->_tpl->assign('tag',$_content->tag);
            $this->_tpl->assign('content',Tool::unHtml($_content->content));
            $this->getNav($_content->nav);
            // 判断缓存是否开启
            if (IS_CACHE) {
                $this->_tpl->assign('count','<script type="text/javascript">getContentCount();</script>');
                $this->_tpl->assign('comment','<script type="text/javascript">getComment();</script>');
            } else {
                $this->_tpl->assign('comment', $_comment->getCommentToTal());
                $this->_tpl->assign('count',$_content->count);
            }
            $_object = $_comment->getNewThreeComment();
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
            $this->_tpl->assign('NewThreeComment', $_object);
        } else {
            Tool::alertBack('警告：非法操作！');
        }
    }

    // 获取前台显示导航
    private function getNav($_id)
    {
        $_nav = new NavModel();
        $_nav->id = $_id;
        if ($_result = $_nav->getOneNav()) {
            // 主导航
            if ($_result->iid) {
                $_nav1 = '<a href="/list.php?id='. $_result->iid.'">'.$_result->nnav_name.'</a> &gt; ';
            } else {
                $_nav1 = '';
            }
            $_nav2 = '<a href="/list.php?id='.$_result->id.'">'.$_result->nav_name.'</a>';
            $this->_tpl->assign('nav', $_nav1.$_nav2);
            // 子导航
            $this->_tpl->assign('childNav', $_nav->getAllChildFrontNav());
        } else {
            Tool::alertBack('警告: 此导航不存在!');
        }
    }
}
