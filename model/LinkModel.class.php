<?php

// 友情链接实体类
class LinkModel extends Model {
    private $id;
    private $webname;
    private $weburl;
    private $logourl;
    private $user;
    private $type;
    private $state;
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

    // 前20个文字链接
    public function getTwentyTextLink()
    {
        $_sql = "SELECT 
                        webname,
                        weburl
                    FROM 
                        cms_link 
                    WHERE 
                        type=1
                    AND
                        state=1
                    ORDER BY
                        id DESC
                    LIMIT 0,20";
        return parent::all($_sql);
    }

    // 前9个LOGo链接
    public function getLineLogoLink()
    {
        $_sql = "SELECT 
                        webname,
                        weburl,
                        logourl
                    FROM 
                        cms_link 
                    WHERE 
                        type=2
                    AND
                        state=1
                    ORDER BY
                        id DESC
                    LIMIT 0,9";
        return parent::all($_sql);
    }

        // 前文字链接
    public function getAllTextLink()
    {
        $_sql = "SELECT 
                        webname,
                        weburl
                    FROM 
                        cms_link 
                    WHERE 
                        type=1
                    AND
                        state=1
                    ORDER BY
                        id DESC
                    LIMIT 0,20";
        return parent::all($_sql);
    }

    // 前LOGo链接
    public function getAllLogoLink()
    {
        $_sql = "SELECT 
                        webname,
                        weburl,
                        logourl
                    FROM 
                        cms_link 
                    WHERE 
                        type=2
                    AND
                        state=1
                    ORDER BY
                        id DESC";
        return parent::all($_sql);
    }

    // 修改
    public function updateLink()
    {
        $_sql = "UPDATE 
                        cms_link 
                    SET 
                        webname='$this->webname',
                        weburl='$this->weburl',
                        logourl='$this->logourl',
                        type='$this->type',
                        user='$this->user',
                        state='$this->state' 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::aud($_sql);
    }

    // 新增
    public function addLink()
    {
        $_sql = "INSERT INTO
                              cms_link (
                                          webname,
                                          weburl,
                                          logourl,
                                          user,
                                          type,
                                          state,
                                          date
                              )
                              VALUES (
                                      '$this->webname',
                                      '$this->weburl',
                                      '$this->logourl',
                                      '$this->user',
                                      '$this->type',
                                      '$this->state',
                                      NOW()
                              )";
        return parent::aud($_sql);
    }

    // 查询所有
    public function getAllLink()
    {
        $_sql = "SELECT 
                        id,
                        webname,
                        weburl,
                        logourl,
                        user,
                        state,
                        type,
                        date
                    FROM 
                        cms_link 
                    ORDER BY
                        id DESC
                    $this->limit";
        return parent::all($_sql);
    }

    // 获取总量
    public function getLinkTotal()
    {
      $_sql = "SELECT COUNT(*) FROM cms_link";
      return parent::total($_sql);
    }

    // 查询单个
    public function getOneLink()
    {
        $_sql = "SELECT 
                        *
                    FROM 
                        cms_link 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::one($_sql);
    }

    // 取消
    public function setStateCancel()
    {
      $_sql = "UPDATE 
                    cms_link 
                SET 
                    state=0 
              WHERE 
                      id='$this->id'
                  ";
      return parent::aud($_sql);
    }

    // 确定
    public function setStateOk()
    {
      $_sql = "UPDATE 
                    cms_link 
                SET 
                    state=1 
              WHERE 
                      id='$this->id' 
                LIMIT 
                      1";
      return parent::aud($_sql);
    }

    // 删除
    public function deleteLink()
    {
        // 值得加引号,否则值是字符串的时候会误报
        $_sql = "DELETE FROM 
                              cms_link 
                          WHERE 
                              id='$this->id' 
                            ";
        return parent::aud($_sql);
    }
}
