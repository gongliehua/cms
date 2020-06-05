<?php

// 投票实体类
class VoteModel extends Model {
    private $id;
    private $title;
    private $info;
    private $vid;
    private $count;
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

    // 累计投票
    public function setCount()
    {
        $_sql = "UPDATE 
                        cms_vote 
                SEt 
                        count=count+1 
                WHERE 
                        id='$this->id'";
        return parent::aud($_sql);
    }

    // 获取首选标题
    public function getVoteTitleOne()
    {
        $_sql = "SELECT title FROM cms_vote WHERE state=1 AND vid=0 LIMIT 1";
        return parent::one($_sql);
    }

    // 获取首选项目
    public function getVoteItem()
    {
        $_sql = "SELECT 
                        id,title 
                FROM 
                        cms_vote 
                WHERE
                        vid=(SELECT id FROM cms_vote WHERE state=1 AND vid=0 LIMIT 1)
                    ";
        return parent::all($_sql);
    }

    // 获取总量
    public function getVoteToTal()
    {
      $_sql = "SELECT COUNT(*) FROM cms_vote WHERE vid=0";
      return parent::total($_sql);
    }

    // 获取总量项目
    public function getChildVoteToTal()
    {
      $_sql = "SELECT COUNT(*) FROM cms_vote WHERE vid='$this->id'";
      return parent::total($_sql);
    }

    // 查询单个
    public function getOneVote()
    {
        $_sql = "SELECT 
                        *
                    FROM 
                        cms_vote 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::one($_sql);
    }

    // 取消投票首选
    public function setStateCancel()
    {
      $_sql = "UPDATE 
                    cms_vote 
                SET 
                    state=0 
              WHERE 
                      state=1
                  ";
      return parent::aud($_sql);
    }

    // 确定投票首选
    public function setStateOk()
    {
      $_sql = "UPDATE 
                    cms_vote 
                SET 
                    state=1 
              WHERE 
                      id='$this->id' 
                LIMIT 
                      1";
      return parent::aud($_sql);
    }

    // 查询所有
    public function getAllVote()
    {
        $_sql = "SELECT 
                        id,
                        title,
                        info,
                        vid,
                        count,
                        state,
                        date
                    FROM 
                        cms_vote 
                    WHERE
                        vid=0
                    ORDER BY
                        id DESC
                    $this->limit";
        return parent::all($_sql);
    }

    // 查询所有,项目
    public function getAllChildVote()
    {
        $_sql = "SELECT 
                        id,
                        title,
                        info,
                        vid,
                        count,
                        state,
                        date
                    FROM 
                        cms_vote 
                    WHERE
                        vid='$this->id'
                    ORDER BY
                        id DESC
                    $this->limit";
        return parent::all($_sql);
    }

    // 新增
    public function addVote()
    {
        $_sql = "INSERT INTO
                              cms_vote (
                                          title,
                                          info,
                                          vid,
                                          date
                              )
                              VALUES (
                                      '$this->title',
                                      '$this->info',
                                      '$this->vid',
                                      NOW()
                              )";
        return parent::aud($_sql);
    }

    // 修改
    public function updateVote()
    {
        $_sql = "UPDATE 
                        cms_vote 
                    SET 
                        title='$this->title',
                        info='$this->info' 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::aud($_sql);
    }

    // 删除
    public function deleteVote()
    {
        // 值得加引号,否则值是字符串的时候会误报
        $_sql = "DELETE FROM 
                              cms_vote 
                          WHERE 
                              id='$this->id' 
                            OR
                            vid='$this->id'
                            ";
        return parent::aud($_sql);
    }
}
