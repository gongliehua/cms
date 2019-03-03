<?php

// 管理员实体类
class ManageModel extends Model {
    private $id;
    private $admin_user;
    private $admin_pass;
    private $level;

    // 拦截器
    public function __set($_key,$_value)
    {
        $this->$_key = $_value;
    }

    // 拦截器
    public function __get($_key)
    {
        return $this->$_key;
    }

    // 查询单个管理员
    public function getOneManage()
    {
        $_sql = "SELECT 
                        id,admin_user,level 
                    FROM 
                        cms_manage 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::one($_sql);
    }

    // 查询所有管理员
    public function getManage()
    {
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
        return parent::all($_sql);
    }

    // 新增管理员
    public function addManage()
    {
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
        return parent::aud($_sql);
    }

    // 修改管理员
    public function updateManage()
    {
        $_sql = "UPDATE 
                        cms_manage 
                    SET 
                        admin_pass='$this->admin_pass', 
                        level='$this->level' 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::aud($_sql);
    }

    // 删除管理员
    public function deleteManage()
    {
        // 值得加引号,否则值是字符串的时候会误报
        $_sql = "DELETE FROM 
                              cms_manage 
                          WHERE 
                              id='$this->id' 
                          LIMIT 1";
        return parent::aud($_sql);
    }
}
