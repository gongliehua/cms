<?php

// 内容实体类
class ContentModel extends Model {
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
