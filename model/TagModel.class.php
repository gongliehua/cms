<?php

// 标签实体类
class TagModel extends Model {
    private $id;
    private $tagname;
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

    // 累计
    public function addTagCount()
    {
        $_sql = "UPDATE 
                        cms_tag 
                SEt 
                        count=count+1 
                WHERE 
                        tagname='$this->tagname'";
        return parent::aud($_sql);
    }

    // 查找单一
    public function getOneTag()
    {
        $_sql = "SELECT id FROM cms_tag WHERE tagname='$this->tagname' LIMIT 1";
        return parent::one($_sql);
    }

    // 新增
    public function addTag()
    {
        $_sql = "INSERT INTO
                              cms_tag (
                                          tagname
                              )
                              VALUES (
                                      '$this->tagname'
                              )";
        return parent::aud($_sql);
    }

    // 获取前5个标签
    public function getTopFiveTag()
    {
        $_sql = "SELECT 
                        tagname,
                        count
                FROM 
                        cms_tag 
                ORDER BY
                        count DESC
                LIMIT 5
                    ";
        return parent::all($_sql);
    }
}
