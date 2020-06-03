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
    private $sort;
    private $readlimit;
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

    //获取本月、本类、推荐排行榜 10条
    public function getMonthNavRec()
    {
      $_sql = "SELECT 
                      id,
                      title,
                      date
                FROM 
                      cms_content 
                WHERE 
                      nav IN($this->nav)
                  AND
                      MONTH(NOW())=DATE_FORMAT(date,'%c')
                  AND
                      attr LIKE '%推荐%'
              ORDER BY 
                      date DESC 
                LIMIT 
                      0,10";
      return parent::all($_sql);
    }

    //获取本月、本类、热点排行榜 10条
    public function getMonthNavHot()
    {
      $_sql = "SELECT 
                      ct.id,
                      ct.title,
                      ct.date
                FROM 
                      cms_content ct
                WHERE 
                      ct.nav IN($this->nav)
                  AND
                      MONTH(NOW())=DATE_FORMAT(ct.date,'%c')
              ORDER BY 
                      (SELECT 
                            COUNT(*) 
                      FROM 
                            cms_comment c 
                      WHERE 
                            c.cid=ct.id) DESC
                LIMIT 
                      0,10";
      return parent::all($_sql);
    }

    //获取本月、本类、图片排行榜 10条
    public function getMonthNavPic()
    {
      $_sql = "SELECT 
                      id,
                      title,
                      date
                FROM 
                      cms_content ct
                WHERE 
                      nav IN($this->nav)
                  AND
                      MONTH(NOW())=DATE_FORMAT(date,'%c')
                  AND
                      thumbnail<>''
              ORDER BY 
                      date DESC
                LIMIT 
                      0,10";
      return parent::all($_sql);
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

    //累计文档的点击量
    public function setContentCount()
    {
      $_sql = "UPDATE 
                    cms_content 
                SET 
                      count=count+1 
              WHERE 
                    id='$this->id' 
              LIMIT 
                    1";
      return parent::aud($_sql);
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
                      c.nav,
                      c.title t,
                      c.attr,
                      c.info,
                      c.thumbnail,
                      c.date,
                      c.count,
                      c.gold,
                      n.nav_name
                FROM 
                          cms_content c,
                          cms_nav n
                WHERE 
                          c.nav = n.id 
                      AND 
                          c.nav IN ($this->nav) 
                      ORDER BY
                          c.date DESC 
                      $this->limit";
      return parent::all($_sql);
    }

    //获取单一的文档内容
    public function getOneContent() {
      $_sql = "SELeCt 
                      id,
                      title,
                      nav,
                      content,
                      info,
                      date,
                      count,
                      author,
                      source,
                      tag, 
                      keyword,
                      thumbnail,
                      gold,
                      attr,
                      color,
                      sort,
                      readlimit,
                      commend
                FROM 
                      cms_content
                WHERE
                      id='$this->id'";
      return parent::one($_sql);
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
                                          sort,
                                          readlimit,
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
                                      '$this->sort',
                                      '$this->readlimit',
                                      NOW()
                              )";
        return parent::aud($_sql);
    }

    //修改文档
    public function updateContent(){
      $_sql = "UPDATE 
                      cms_content 
                SET 
                    title='$this->title',
                    nav='$this->nav',
                    info='$this->info',
                    thumbnail='$this->thumbnail',
                    source='$this->source',
                    author='$this->author',
                    tag='$this->tag',
                    keyword='$this->keyword',
                    attr='$this->attr',
                    content='$this->content',
                    gold='$this->gold',
                    commend='$this->commend',
                    count='$this->count',
                    color='$this->color',
                    sort='$this->sort',
                    readlimit='$this->readlimit'
                WHERE 
                    id='$this->id'
                LIMIT 
                    1";
      return parent::aud($_sql);
    }

    //删除文档
    public function deleteContent()
    {
      $_sql = "DELETE FROM 
                          cms_content 
                WHERE 
                        id='$this->id' 
                LIMIT 
                        1";
      return parent::aud($_sql);
    }
}
