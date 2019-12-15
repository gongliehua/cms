<?php

//数据库连接类
class DB {
    //获取对象句柄
    public static function getDB()
    {
        $_mysqli = @new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if (mysqli_connect_errno()) {
            exit(mysqli_connect_error());
        }
        $_mysqli->set_charset('utf8mb4');
        return $_mysqli;
    }

    //清理
    public static function unDB(&$_result,&$_db)
    {
        if (is_object($_result)) {
            $_result->free();
        }
        if (is_object($_db)) {
            $_db->close();
        }
        unset($_result,$_db);
    }
}
