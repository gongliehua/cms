<?php

// 会员实体类
class UserModel extends Model {
    private $id;
    private $user;
    private $pass;
    private $email;
    private $question;
    private $answer;
    private $face;
    private $time;
    private $state;
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

    // 修改
    public function updateUser()
    {
        $_sql = "UPDATE 
                        cms_user 
                    SET 
                        pass='$this->pass',
                        email='$this->email',
                        face='$this->face',
                        question='$this->question',
                        answer='$this->answer',
                        state='$this->state' 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::aud($_sql);
    }

    // 查询单个
    public function getOneUser()
    {
        $_sql = "SELECT 
                        id,
                        user,
                        pass,
                        face,
                        email,
                        state,
                        question,
                        answer
                    FROM 
                        cms_user 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::one($_sql);
    }

    // 删除
    public function deleteUser()
    {
        // 值得加引号,否则值是字符串的时候会误报
        $_sql = "DELETE FROM 
                              cms_user 
                          WHERE 
                              id='$this->id' 
                          LIMIT 1";
        return parent::aud($_sql);
    }

    // 获取会员总个数
    public function getUserTotal()
    {
      $_sql = "SELECT 
                    COUNT(*) 
                FROM 
                        cms_user";
      return parent::total($_sql);
    }

    // 获取所有的会员
    public function getAllUser()
    {
      $_sql = "SELECT 
                        id,
                        user,
                        email,
                        state
                    FROM 
                        cms_user 
                    ORDER BY
                        date DESC";
        return parent::all($_sql);
    }

    // 获取6条最新登录的会员
    public function getLaterUser()
    {
      $_sql = "SELECT 
                      user,
                      face 
                FROM 
                      cms_user 
                  ORDER BY 
                            time DESC 
                  LIMIT 
                        6";
      return parent::all($_sql);
    }

    // 注册和登录更新最近的登录时间戳
    public function setLaterUser()
    {
      $_sql = "UPDATE 
                      cms_user 
                  SET 
                        time='$this->time' 
                WHERE 
                          id='$this->id' 
                  LIMIT 
                          1";
      return parent::aud($_sql);
    }

    // 用户名重复
    public function checkUser()
    {
      $_sql = "SELECT 
                    id 
                FROM 
                      cms_user 
              WHERE 
                      user='$this->user' 
                LIMIT 
                      1";
      return parent::one($_sql);
    }

    // 邮箱重复
    public function checkEmail()
    {
      $_sql = "SELECT 
                    id 
                FROM 
                      cms_user 
              WHERE 
                      email='$this->email' 
                LIMIT 
                      1";
      return parent::one($_sql);
    }

    // 检查登录
    public function checkLogin()
    {
        $_sql = "SELECT 
                        id,
                        user,
                        pass,
                        face 
                FROM 
                        cms_user 
                WHERE 
                        user='$this->user' 
                AND 
                        pass='$this->pass' 
                LIMIT 
                        1";
        return parent::one($_sql);
    }

    // 新增
    public function addUser()
    {
        $_sql = "INSERT INTO
                              cms_user (
                                          user,
                                          pass,
                                          email,
                                          question,
                                          answer,
                                          face,
                                          time,
                                          state,
                                          date
                              )
                              VALUES (
                                      '$this->user',
                                      '$this->pass',
                                      '$this->email',
                                      '$this->question',
                                      '$this->answer',
                                      '$this->face',
                                      '$this->time',
                                      '$this->state',
                                      NOW()
                              )";
        return parent::aud($_sql);
    }
}
