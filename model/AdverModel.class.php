<?php

// 广告实体类
class AdverModel extends Model {
    private $id;
    private $title;
    private $thumbnail;
    private $link;
    private $type;
    private $state;
    private $date;
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

    // 获取最新的N条文字广告
    public function getNewTextAdver()
    {
        $_sql = "SELECT 
                        title,
                        link 
                FROM 
                        cms_adver 
                WHERE 
                        state=1 
                    AND 
                        type=1 
                ORDER BY 
                        date DESC 
                LIMIT 
                        0,".ADVER_TEXT_NUM;
        return parent::all($_sql);
    }

    // 获取最新的N条头部广告
    public function getNewHeaderAdver()
    {
        $_sql = "SELECT 
                        title,
                        link,
                        thumbnail
                FROM 
                        cms_adver 
                WHERE 
                        state=1 
                    AND 
                        type=2 
                ORDER BY 
                        date DESC 
                LIMIT 
                        0,".ADVER_PIC_NUM;
        return parent::all($_sql);
    }

    // 获取最新的N条侧栏广告
    public function getNewSidebarAdver()
    {
        $_sql = "SELECT 
                        title,
                        link,
                        thumbnail
                FROM 
                        cms_adver 
                WHERE 
                        state=1 
                    AND 
                        type=3 
                ORDER BY 
                        date DESC 
                LIMIT 
                        0,".ADVER_PIC_NUM;
        return parent::all($_sql);
    }

    // 查询单个
    public function getOneAdver()
    {
        $_sql = "SELECT 
                        id,
                        title,
                        thumbnail,
                        link,
                        type,
                        state,
                        info
                    FROM 
                        cms_adver 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::one($_sql);
    }

    // 通过
    public function setStateOk()
    {
      $_sql = "UPDATE 
                    cms_adver 
                SET 
                    state=1 
              WHERE 
                      id='$this->id' 
                LIMIT 
                      1";
      return parent::aud($_sql);
    }

    // 取消
    public function setStateCancel()
    {
      $_sql = "UPDATE 
                    cms_adver 
                SET 
                    state=0 
              WHERE 
                      id='$this->id' 
                LIMIT 
                      1";
      return parent::aud($_sql);
    }

    // 查询总数
    public function getAdverTotal()
    {
        $_sql = "SELECT COUNT(*) FROM cms_adver";
      return parent::total($_sql);
    }

    // 查询所有
    public function getAllAdver()
    {
        $_sql = "SELECT 
                        id,
                        title,
                        link,
                        type,
                        state
                    FROM 
                        cms_adver
                    ORDER BY
                        id DESC
                    $this->limit";
        return parent::all($_sql);
    }

    // 新增
    public function addAdver()
    {
        $_sql = "INSERT INTO
                              cms_adver (
                                          title,
                                          thumbnail,
                                          link,
                                          type,
                                          info,
                                          state,
                                          date
                              )
                              VALUES (
                                      '$this->title',
                                      '$this->thumbnail',
                                      '$this->link',
                                      '$this->type',
                                      '$this->info',
                                      1,
                                      NOW()
                              )";
        return parent::aud($_sql);
    }

    // 修改
    public function updateAdver()
    {
        $_sql = "UPDATE 
                        cms_adver 
                    SET 
                        title='$this->title',
                        thumbnail='$this->thumbnail',
                        info='$this->info',
                        link='$this->link',
                        type='$this->type',
                        state='$this->state'
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::aud($_sql);
    }

    // 删除
    public function deleteAdver()
    {
        // 值得加引号,否则值是字符串的时候会误报
        $_sql = "DELETE FROM 
                              cms_adver 
                          WHERE 
                              id='$this->id' 
                          LIMIT 1";
        return parent::aud($_sql);
    }
}
