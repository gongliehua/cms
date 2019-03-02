<?php

// 管理员实体类
class Manage {
    // 查询所有管理员
    public function getManage()
    {
        $_db = DB::getDB();
        $_sql = "SELECT 
                        m.id,
                        m.admin_user,
                        m.level,
                        m.login_count,
                        m.last_ip,
                        m.last_time,
                        l.level_name
                    FROM 
                        cms_manage m,
                        cms_level l
                    WHERE
                        l.level = m.level
                    ORDER BY
                        id ASC
                    LIMIT
                        0,10";
        $_result = $_db->query($_sql);
        while ($_objects = $_result->fetch_object()) {
            $_html[] = $_objects;
        }
        DB::unDB($_result,$_db);
        return $_html;
    }

    // 新增管理员
    public function addManage()
    {

    }

    // 修改管理员
    public function updateManage()
    {

    }

    // 删除管理员
    public function deleteManage()
    {

    }
}
