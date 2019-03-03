<?php

// 管理员实体类
class Manage {
    private $_tpl;
    private $id;
    private $admin_user;
    private $admin_pass;
    private $level;

    // 初始化
    public function __construct(&$_tpl)
    {
        $this->_tpl = $_tpl;
        $this->Action();
    }

    private function Action()
    {
        // 业务流程控制器
        $_GET['action'] = isset($_GET['action']) ? $_GET['action'] : 'list';
        switch ($_GET['action']) {
            case 'list':
                $this->_tpl->assign('list',true);
                $this->_tpl->assign('add',false);
                $this->_tpl->assign('update',false);
                $this->_tpl->assign('title','管理员列表');
                $this->_tpl->assign('AllManage',$this->getManage());
                break;
            case 'add':
                if (isset($_POST['send'])) {
                    $this->admin_user = $_POST['admin_user'];
                    $this->admin_pass = sha1($_POST['admin_pass']);
                    $this->level = $_POST['level'];
                    $this->addManage() ? Tool::alertLocation('恭喜你，新增管理员成功！','manage.php?action=list') : Tool::alertBack('很遗憾，新增管理员失败！');
                }
                $this->_tpl->assign('list',false);
                $this->_tpl->assign('add',true);
                $this->_tpl->assign('update',false);
                $this->_tpl->assign('title','新增管理员');
                break;
            case 'update':
                if (isset($_POST['send'])) {
                    $this->id = $_POST['id'];
                    $this->admin_pass = sha1($_POST['admin_pass']);
                    $this->level = $_POST['level'];
                    $this->updateManage() ? Tool::alertLocation('恭喜你，修改管理员成功！','manage.php?action=list') : Tool::alertBack('很遗憾，修改管理员失败！');
                }
                if (isset($_GET['id'])) {
                    $this->id = $_GET['id'];
                    is_object($this->getOneManage()) ? true : Tool::alertBack('您传值的ID有误！');
                    $this->_tpl->assign('id',$this->getOneManage()->id);
                    $this->_tpl->assign('level',$this->getOneManage()->level);
                    $this->_tpl->assign('admin_user',$this->getOneManage()->admin_user);
                    $this->_tpl->assign('list',false);
                    $this->_tpl->assign('add',false);
                    $this->_tpl->assign('update',true);
                    $this->_tpl->assign('title','修改管理员');
                } else {
                    Tool::alertBack('非法操作！');
                }
                break;
            case 'delete':
                if (isset($_GET['id'])) {
                    $this->id = $_GET['id'];
                    $this->deleteManage() ? Tool::alertLocation('恭喜你，删除管理员成功！','manage.php?action=list') : Tool::alertBack('很遗憾，删除管理员失败！');
                } else {
                    Tool::alertBack('非法操作！');
                }
                break;
            default:
                Tool::alertBack('非法操作！');
        }
        $this->_tpl->display('manage.tpl');
    }

    // 查询单个管理员
    public function getOneManage()
    {
        $_db = DB::getDB();
        $_sql = "SELECT 
                        id,admin_user,level 
                    FROM 
                        cms_manage 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        $_result = $_db->query($_sql);
        $_objects = $_result->fetch_object();
        DB::unDB($_result,$_db);
        return $_objects;
    }

    // 查询所有管理员
    public function getManage()
    {
        $_db = DB::getDB();
        $_sql = "SELECT 
                        m.id,
                        m.admin_user,
                        m.level,
                        m.login_count,
                        m.last_ip,
                        m.last_time,
                        l.level_name
                    FROM 
                        cms_manage m,
                        cms_level l
                    WHERE
                        l.level = m.level
                    ORDER BY
                        id ASC
                    LIMIT
                        0,20";
        $_result = $_db->query($_sql);
        $_html = [];
        while ($_objects = $_result->fetch_object()) {
            $_html[] = $_objects;
        }
        DB::unDB($_result,$_db);
        return $_html;
    }

    // 新增管理员
    public function addManage()
    {
            $_db = DB::getDB();
            $_sql = "INSERT INTO
                                  cms_manage (
                                              admin_user,
                                              admin_pass,
                                              level,
                                              reg_time
                                  )
                                  VALUES (
                                          '$this->admin_user',
                                          '$this->admin_pass',
                                          '$this->level',
                                          NOW()
                                  )";
            $_result = $_db->query($_sql);
            $_affected_rows = $_db->affected_rows;
            DB::unDB($_result,$_db);
            return $_affected_rows;
    }

    // 修改管理员
    public function updateManage()
    {
        $_db = DB::getDB();
        $_sql = "UPDATE 
                        cms_manage 
                    SET 
                        admin_pass='$this->admin_pass', 
                        level='$this->level' 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        $_result = $_db->query($_sql);
        $_affected_rows = $_db->affected_rows;
        DB::unDB($_result,$_db);
        return $_affected_rows;
    }

    // 删除管理员
    public function deleteManage()
    {
        $_db = DB::getDB();
        // 值得加引号,否则值是字符串的时候会误报
        $_sql = "DELETE FROM 
                              cms_manage 
                          WHERE 
                              id='$this->id' 
                          LIMIT 1";
        $_result = $_db->query($_sql);
        $_affected_rows = $_db->affected_rows;
        DB::unDB($_result,$_db);
        return $_affected_rows;
    }
}
