<?php

// 配置实体类
class SystemModel extends Model {
    private $id;
    private $webname;
    private $pae_size;
    private $article_size;
    private $nav_size;
    private $ro_time;
    private $ro_num;
    private $updir;
    private $adver_text_num;
    private $adver_pic_num;

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

    // 修改数据
    public function setSystem()
    {
        $_sql = "UPDATE 
                        cms_system 
                SET 
                        webname='$this->webname',
                        page_size='$this->page_size',
                        article_size='$this->article_size',
                        nav_size='$this->nav_size',
                        updir='$this->updir',
                        ro_time='$this->ro_time',
                        ro_num='$this->ro_num',
                        adver_text_num='$this->adver_text_num',
                        adver_pic_num='$this->adver_pic_num'
                 WHERE
                         id=1";
        return parent::aud($_sql);
    }

    // 获取数据
    public function getSystem()
    {
        $_sql = "SELECT 
                        *
                    FROM 
                        cms_system 
                    WHERE 
                        id=1 
                    LIMIT 
                        1";
        return parent::one($_sql);
    }
}
