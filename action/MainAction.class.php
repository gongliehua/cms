<?php

// 控制器
class MainAction extends Action {
    // 初始化
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl);
    }

    // 流程控制器
    public function _action()
    {
        $this->cacheNum();

        $_GET['action'] = isset($_GET['action']) ? $_GET['action'] : '';
        if ($_GET['action'] == 'delcache') {
            $this->delCache();
        }
    }

    // 计算缓存目录的文件
    private function cacheNum(){
        $_dir = ROOT_PATH.'/cache/';
        $_num = sizeof(scandir($_dir)) - 2;
        $this->_tpl->assign('cacheNum', $_num);
    }

    // 清理缓存
    private function delCache()
    {
        if (strstr($_SESSION['admin']['permission'],'2') === false) {
            Tool::alertBack("警告：你没有权限操作");
        }
        $_dir = ROOT_PATH.'/cache/';
        if (!$_dh = @opendir($_dir)) return;
        while (false !== ($_obj = readdir($_dh))) {
            if ($_obj == '.' || $_obj == '..') continue;
            @unlink($_dir.'/'.$_obj);
        }
        closedir($_dh);
        Tool::alertLocation('恭喜，缓存清理完毕！','main.php');
    }
}
