<?php

// 导航实体类
class NavModel extends Model {
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
                        cms_nav";
        return parent::total($_sql);
    }

    // 查询所有
    public function getAllNav()
    {
        $_sql = "SELECT 
                        id,
                        nav_name,
                        nav_info
                    FROM 
                        cms_nav 
                    $this->limit";
        return parent::all($_sql);
    }
}
