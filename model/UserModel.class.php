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

    // 检查登录
    public function checkLogin()
    {
        $_sql = "SELECT 
                        user,pass 
                FROM 
                        cms_user 
                WHERE 
                        user='$this->user' 
                AND 
                        pass='$this->pass' 
                LIMIT 
                        1";
        return parent::aud($_sql);
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
                                          date
                              )
                              VALUES (
                                      '$this->user',
                                      '$this->pass',
                                      '$this->email',
                                      '$this->question',
                                      '$this->answer',
                                      '$this->face',
                                      NOW()
                              )";
        return parent::aud($_sql);
    }
}
