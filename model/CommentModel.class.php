<?php

// 评论实体类
class CommentModel extends Model {
    private $id;
    private $user;
    private $content;
    private $state;
    private $manner;
    private $cid;
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

    // 获取总排行榜 文档的评论量从大到小 20条
    public function getHotTwentyComment()
    {
      $_sql = "SELECT 
                      ct.id,
                      ct.title 
                FROM 
                      cms_content ct
                ORDER BY
                      (SELECT 
                            COUNT(*) 
                      FROM 
                            cms_comment c 
                      WHERE 
                            c.cid=ct.id) DESC
                LIMIT 
                      0,20";
      return parent::all($_sql);
    }

    // 获取最火3条评论,如果其中有支持+反对就不现实出来
    public function getHotThreeComment()
    {
      $_sql = "SELECT 
                    c.id,
                    c.cid,
                    c.user,
                    c.manner,
                    c.content,
                    c.date,
                    c.sustain,
                    c.oppose,
                    u.face
                FROM 
                      cms_comment c
                LEFT JOIN
                      cms_user u
                    ON
                      c.user=u.user
                WHERE 
                        c.cid='$this->cid'
                    AND
                        c.sustain+c.oppose>0
                ORDER BY
                        c.sustain+c.oppose DESC
                LIMIT 0,3
                ";
      return parent::all($_sql);
    }

    // 获取最新3条评论
    public function getNewThreeComment()
    {
      $_sql = "SELECT 
                    c.id,
                    c.cid,
                    c.user,
                    c.manner,
                    c.content,
                    c.date,
                    c.sustain,
                    c.oppose,
                    u.face
                FROM 
                      cms_comment c
                LEFT JOIN
                      cms_user u
                    ON
                      c.user=u.user
                WHERE 
                        cid='$this->cid'
                ORDER BY
                        c.date DESC
                LIMIT 0,3
                ";
      return parent::all($_sql);
    }

    // 获取评论总量
    public function getCommentToTal()
    {
      $_sql = "SELECT COUNT(*) FROM cms_comment WHERE cid='$this->cid'";
      return parent::total($_sql);
    }

    // 查找单一评论
    public function getOneComment()
    {
      $_sql = "SELECT id FROM cms_comment WHERE id='$this->id' LIMIT 1";
      return parent::one($_sql);
    }

    // 支持
    public function setSustain()
    {
      $_sql = "UPDATE 
                cms_comment 
            SET 
                  sustain=sustain+1 
            WHERE 
                    id='$this->id' 
            LIMIT 
                    1";
      return parent::aud($_sql);
    }

    public function setOppose()
    {
      $_sql = "UPDATE 
                cms_comment 
            SET 
                  oppose=oppose+1 
            WHERE 
                    id='$this->id' 
            LIMIT 
                    1";
      return parent::aud($_sql);
    }

    // 所有评论
    public function getAllComment()
    {
      $_sql = "SELECT 
                    c.id,
                    c.cid,
                    c.user,
                    c.manner,
                    c.content,
                    c.date,
                    c.sustain,
                    c.oppose,
                    u.face
                FROM 
                      cms_comment c
                LEFT JOIN
                      cms_user u
                    ON
                      c.user=u.user
                WHERE 
                        cid='$this->cid'
                ORDER BY
                        c.date DESC
                        $this->limit
                ";
      return parent::all($_sql);
    }

    // 新增
    public function addComment()
    {
        $_sql = "INSERT INTO
                              cms_comment (
                                          user,
                                          manner,
                                          content,
                                          cid,
                                          date
                              )
                              VALUES (
                                      '$this->user',
                                      '$this->manner',
                                      '$this->content',
                                      '$this->cid',
                                      NOW()
                              )";
        return parent::aud($_sql);
    }
}
