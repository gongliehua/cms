<?php

// 模型基类
class model {

    // 查找总记录模型
    protected function total($_sql)
    {
        $_db = DB::getDB();
        $_result = $_db->query($_sql);
        $_total = $_result->fetch_row();
        DB::unDB($_result,$_db);
        return $_total[0];
    }

    // 查找单个数据模型
    protected function one($_sql)
    {
        $_db = DB::getDB();
        $_result = $_db->query($_sql);
        $_objects = $_result->fetch_object();
        DB::unDB($_result,$_db);
        return $_objects;
    }

    // 查找多个数据模型
    protected function all($_sql)
    {
        $_db = DB::getDB();
        $_result = $_db->query($_sql);
        $_html = [];
        while ($_objects = $_result->fetch_object()) {
            $_html[] = $_objects;
        }
        DB::unDB($_result,$_db);
        return $_html;
    }

    // 增删修改
    protected function aud($_sql)
    {
        $_db = DB::getDB();
        $_result = $_db->query($_sql);
        $_affected_rows = $_db->affected_rows;
        DB::unDB($_result,$_db);
        return $_affected_rows;
    }
}
