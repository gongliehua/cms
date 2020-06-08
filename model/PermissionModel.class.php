<?php

// 权限实体类
class PermissionModel extends Model {
    private $id;
    private $name;
    private $info;
    private $limit;

    // 拦截器
    public function __set($_key,$_value)
    {
        $this->$_key = Tool::mysqlString($_value);
    }

    // 拦截器
    public function __get($_key)
    {
        return $this->$_key;
    }

    // 新增
    public function addPermission()
    {
        $_sql = "INSERT INTO
                              cms_permission (
                                          name,
                                          info
                              )
                              VALUES (
                                      '$this->name',
                                      '$this->info'
                              )";
        return parent::aud($_sql);
    }

    // 查询单个
    public function getOnePermission()
    {
        $_sql = "SELECT 
                        id,
                        name,
                        info 
                    FROM 
                        cms_permission 
                    WHERE 
                        id='$this->id' 
                    OR 
                        name='$this->name' 
                    LIMIT 
                        1";
        return parent::one($_sql);
    }

    // 查询所有数
    public function getPermissionTotal()
    {
        $_sql = "SELECT COUNT(*) FROM cms_permission";
        return parent::total($_sql);
    }

    // 查询所有
    public function getAllPermission()
    {
        $_sql = "SELECT 
                        id,
                        name,
                        info fullinfo,
                        info
                    FROM 
                        cms_permission 
                    ORDER BY
                        id DESC
                        $this->limit";
        return parent::all($_sql);
    }

    // 修改
    public function updatePermission()
    {
        $_sql = "UPDATE 
                        cms_permission 
                    SET 
                        name='$this->name',
                        info='$this->info' 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::aud($_sql);
    }
   
   // 删除
    public function deletePermission()
    {
        // 值得加引号,否则值是字符串的时候会误报
        $_sql = "DELETE FROM 
                              cms_permission 
                          WHERE 
                              id='$this->id' 
                          LIMIT 1";
        return parent::aud($_sql);
    }
}
