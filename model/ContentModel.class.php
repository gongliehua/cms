<?php

// 内容实体类
class ContentModel extends Model {
    private $id;
    private $title;
    private $nav;
    private $attr;
    private $tag;
    private $keyword;
    private $thumbnail;
    private $info;
    private $source;
    private $author;
    private $content;
    private $gold;
    private $commend;
    private $count;
    private $color;
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

    //获取主类下的子类ID
    public function getNavChildId()
    {
      $_sql = "SELECT 
                      id 
                FROM 
                      cms_nav 
              WHERE 
                      pid='$this->id'";
      return parent::all($_sql);
    }

    // 获取文档总记录
    public function getListContentTotal()
    {
        $_sql = "SELECT 
                        COUNT(*) 
                    FROM 
                          cms_content c,
                          cms_nav n
                WHERE 
                          c.nav = n.id 
                      AND 
                          c.nav IN ($this->nav)";
        return parent::total($_sql);
    }

    //获取文档列表
    public function getListContent()
    {
      $_sql = "SELECT 
                      c.id,
                      c.title,
                      c.info,
                      c.thumbnail,
                      c.date,
                      c.count,
                      n.nav_name
                FROM 
                          cms_content c,
                          cms_nav n
                WHERE 
                          c.nav = n.id 
                      AND 
                          c.nav IN ($this->nav) 
                      $this->limit";
      return parent::all($_sql);
    }

    // 新增文档内容
    public function addContent()
    {
        $_sql = "INSERT INTO
                              cms_content (
                                          title,
                                          nav,
                                          info,
                                          thumbnail,
                                          source,
                                          author,
                                          tag,
                                          keyword,
                                          attr,
                                          content,
                                          gold,
                                          commend,
                                          count,
                                          color,
                                          date
                              )
                              VALUES (
                                      '$this->title',
                                      '$this->nav',
                                      '$this->info',
                                      '$this->thumbnail',
                                      '$this->source',
                                      '$this->author',
                                      '$this->tag',
                                      '$this->keyword',
                                      '$this->attr',
                                      '$this->content',
                                      '$this->gold',
                                      '$this->commend',
                                      '$this->count',
                                      '$this->color',
                                      NOW()
                              )";
        return parent::aud($_sql);
    }
}
