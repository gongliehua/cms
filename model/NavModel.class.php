<?php

// 导航实体类
class NavModel extends Model {
    private $id;
    private $nav_name;
    private $nav_info;
    private $pid;
    private $sort;
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

    // 查询总记录
    public function getNavTotal()
    {
        $_sql = "SELECT 
                        COUNT(*) 
                    FROM 
                        cms_nav 
                    WHERE 
                        pid=0";
        return parent::total($_sql);
    }

    // 查询子导航总记录
    public function getChildNavTotal()
    {
        $_sql = "SELECT 
                        COUNT(*) 
                    FROM 
                        cms_nav 
                    WHERE 
                        pid=$this->id";
        return parent::total($_sql);
    }

    // 查询所有主导航
    public function getAllNav()
    {
        $_sql = "SELECT 
                        id,
                        nav_name,
                        nav_info
                    FROM 
                        cms_nav 
                    WHERE 
                        pid=0 
                    $this->limit";
        return parent::all($_sql);
    }

    // 查询所有子导航
    public function getAllChildNav()
    {
        $_sql = "SELECT 
                        id,
                        nav_name,
                        nav_info
                    FROM 
                        cms_nav 
                    WHERE 
                        pid=$this->id 
                    $this->limit";
        return parent::all($_sql);
    }

    // 查询单个
    public function getOneNav()
    {
        $_sql = "SELECT 
                        id,
                        nav_name,
                        nav_info
                    FROM 
                        cms_nav 
                    WHERE 
                        id='$this->id' 
                    OR
                        nav_name='$this->nav_name' 
                    LIMIT 
                        1";
        return parent::one($_sql);
    }

    // 新增
    public function addNav()
    {
        $_sql = "INSERT INTO
                              cms_nav (
                                          nav_name,
                                          nav_info,
                                          pid,
                                          sort
                              )
                              VALUES (
                                      '$this->nav_name',
                                      '$this->nav_info',
                                      '$this->pid',
                                      ".parent::nextId('cms_nav')."
                              )";
        return parent::aud($_sql);
    }

    // 修改
    public function updateNav()
    {
        $_sql = "UPDATE 
                        cms_nav 
                    SET 
                        nav_name='$this->nav_name',
                        nav_info='$this->nav_info' 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::aud($_sql);
    }

    // 删除
    public function deleteNav()
    {
        // 值得加引号,否则值是字符串的时候会误报
        $_sql = "DELETE FROM 
                              cms_nav 
                          WHERE 
                              id='$this->id' 
                          LIMIT 1";
        return parent::aud($_sql);
    }
}
