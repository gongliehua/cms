<?php

// 控制器
class SystemAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        $_model = new SystemModel();
        parent::__construct($_tpl, $_model);
    }

    // 流程控制器
    public function _action()
    {
        $this->show();
    }

    // show
    private function show()
    {
        if (isset($_POST['send'])) {
            $this->_model->webname = $_POST['webname'];
            $this->_model->page_size = $_POST['page_size'];
            $this->_model->article_size = $_POST['article_size'];
            $this->_model->nav_size = $_POST['nav_size'];
            $this->_model->updir = $_POST['updir'];
            $this->_model->ro_time = $_POST['ro_time'];
            $this->_model->ro_num = $_POST['ro_num'];
            $this->_model->adver_text_num = $_POST['adver_text_num'];
            $this->_model->adver_pic_num = $_POST['adver_pic_num'];
            if ($this->_model->setSystem()) {
                // 写入配置文件
                $_br = "\r\n";
                $_tab = "\t";
                $_profile = "<?php".$_br;
                $_profile .= $_br."// 可配置项";
                $_profile .= $_br."define('WEBNAME', '{$this->_model->webname}');";
                $_profile .= $_br."define('PAGE_SIZE', {$this->_model->page_size});";
                $_profile .= $_br."define('ARTICLE_SIZE', {$this->_model->article_size});";
                $_profile .= $_br."define('NAV_SIZE', {$this->_model->nav_size});";
                $_profile .= $_br."define('UPDIR', '{$this->_model->updir}');";
                $_profile .= $_br."define('RO_TIME', {$this->_model->ro_time});";
                $_profile .= $_br."define('RO_NUM', {$this->_model->ro_num});";
                $_profile .= $_br."define('ADVER_TEXT_NUM', {$this->_model->adver_text_num});";
                $_profile .= $_br."define('ADVER_PIC_NUM', {$this->_model->adver_pic_num});";
                $_profile .= $_br.$_br."// 固定配置";
                $_profile .= $_br."define('DB_HOST', '127.0.0.1');";
                $_profile .= $_br."define('DB_USER', 'root');";
                $_profile .= $_br."define('DB_PASS', 'root');";
                $_profile .= $_br."define('DB_NAME', 'cms');";
                $_profile .= $_br."define('GPC', get_magic_quotes_gpc());";
                $_profile .= $_br."define('PREV_URL', isset(\$_SEREVER['HTTP_REFERER']) ? \$_SERVER['HTTP_REFERER'] : '/');";
                $_profile .= $_br."define('MARK', ROOT_PATH.'/images/yc.png');";
                $_profile .= $_br."define('TPL_DIR', ROOT_PATH.'/templates/');";
                $_profile .= $_br."define('TPL_C_DIR', ROOT_PATH.'/templates_c/');";
                $_profile .= $_br."define('CACHE_DIR', ROOT_PATH.'/cache/');";
                $_profile .= $_br;
                if (!file_put_contents('../config/profile.inc.php', $_profile)) {
                    Tool::alertBack('修改失败');
                }

                Tool::alertLocation('修改成功', 'system.php');
            } else {
                Tool::alertBack('修改失败');
            }
        }
        $_object = $this->_model->getSystem();
        $this->_tpl->assign('webname', $_object->webname);
        $this->_tpl->assign('page_size', $_object->page_size);
        $this->_tpl->assign('article_size', $_object->article_size);
        $this->_tpl->assign('nav_size', $_object->nav_size);
        $this->_tpl->assign('updir', $_object->updir);
        $this->_tpl->assign('ro_time', $_object->ro_time);
        $this->_tpl->assign('ro_num', $_object->ro_num);
        $this->_tpl->assign('adver_text_num', $_object->adver_text_num);
        $this->_tpl->assign('adver_pic_num', $_object->adver_pic_num);
    }
}
