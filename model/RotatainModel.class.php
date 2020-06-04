<?php

// 轮播实体类
class RotatainModel extends Model {
    private $id;
    private $thumbnail;
    private $title;
    private $info;
    private $state;
    private $link;
    private $date;
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

    // 获取系统指定的个数，最新的轮播器
    public function getNewRotatain()
    {
      $_sql = "SELECT 
                      id,
                      title,
                      thumbnail,
                      link 
              FROM 
                      cms_rotatain 
              WHERE 
                      state=1 
              ORDER BY 
                      date DESC 
              LIMIT 
                      0,".RO_NUM;
      return parent::all($_sql);
    }

    // 通过轮播器
    public function setStateOk()
    {
      $_sql = "UPDATE 
                    cms_rotatain 
                SET 
                    state=1 
              WHERE 
                      id='$this->id' 
                LIMIT 
                      1";
      return parent::aud($_sql);
    }

    // 取消轮播器
    public function setStateCancel()
    {
      $_sql = "UPDATE 
                    cms_rotatain 
                SET 
                    state=0 
              WHERE 
                      id='$this->id' 
                LIMIT 
                      1";
      return parent::aud($_sql);
    }

    // 获取所有
    public function getRotatainTotal()
    {
        $_sql = "SELECT 
                        COUNT(*) 
                    FROM 
                        cms_rotatain";
        return parent::total($_sql);
    }

    // 查询单个
    public function getOneRotatain()
    {
        $_sql = "SELECT 
                        id,
                        title,
                        thumbnail,
                        info,
                        link,
                        state,
                        date
                    FROM 
                        cms_rotatain 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::one($_sql);
    }

    // 查询所有
    public function getAllRotatain()
    {
        $_sql = "SELECT 
                        id,
                        title,
                        link,
                        link full,
                        state
                    FROM 
                        cms_rotatain
                    ORDER BY
                        state DESC,date DESC
                    $this->limit";
        return parent::all($_sql);
    }

    // 新增
    public function addRotatain()
    {
        $_sql = "INSERT INTO
                              cms_rotatain (
                                          thumbnail,
                                          title,
                                          info,
                                          link,
                                          state,
                                          date
                              )
                              VALUES (
                                      '$this->thumbnail',
                                      '$this->title',
                                      '$this->info',
                                      '$this->link',
                                      1,
                                      NOW()
                              )";
        return parent::aud($_sql);
    }

    // 修改
    public function updateRotatain()
    {
        $_sql = "UPDATE 
                        cms_rotatain 
                    SET 
                        thumbnail='$this->thumbnail',
                        title='$this->title',
                        link='$this->link',
                        info='$this->info',
                        state='$this->state'
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::aud($_sql);
    }

    // 删除
    public function deleteRotatain()
    {
        // 值得加引号,否则值是字符串的时候会误报
        $_sql = "DELETE FROM 
                              cms_rotatain 
                          WHERE 
                              id='$this->id' 
                          LIMIT 1";
        return parent::aud($_sql);
    }
}
