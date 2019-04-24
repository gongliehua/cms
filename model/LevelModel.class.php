<?php

// 等级实体类
class LevelModel extends Model {
    private $id;
    private $level_name;
    private $level_info;

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

    // 查询单个
    public function getOneLevel()
    {
        $_sql = "SELECT 
                        id,
                        level_name,
                        level_info 
                    FROM 
                        cms_level 
                    WHERE 
                        id='$this->id' 
                    OR 
                        level_name='$this->level_name' 
                    LIMIT 
                        1";
        return parent::one($_sql);
    }

    // 查询所有
    public function getAllLevel()
    {
        $_sql = "SELECT 
                        id,
                        level_name,
                        level_info
                    FROM 
                        cms_level 
                    ORDER BY
                        id ASC";
        return parent::all($_sql);
    }

    // 新增
    public function addLevel()
    {
        $_sql = "INSERT INTO
                              cms_level (
                                          level_name,
                                          level_info
                              )
                              VALUES (
                                      '$this->level_name',
                                      '$this->level_info'
                              )";
        return parent::aud($_sql);
    }

    // 修改
    public function updateLevel()
    {
        $_sql = "UPDATE 
                        cms_level 
                    SET 
                        level_name='$this->level_name',
                        level_info='$this->level_info' 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::aud($_sql);
    }

    // 删除
    public function deleteLevel()
    {
        // 值得加引号,否则值是字符串的时候会误报
        $_sql = "DELETE FROM 
                              cms_level 
                          WHERE 
                              id='$this->id' 
                          LIMIT 1";
        return parent::aud($_sql);
    }
}
