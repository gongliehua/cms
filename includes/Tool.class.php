<?php

//工具类
class Tool {
    // 弹窗跳转
    public static function alertLocation($_info,$_url)
    {
        if (!empty($_info)) {
            exit("<script type='text/javascript'>alert('$_info');location.href='$_url';</script>");
        } else {
            header("Location: $_url");
            die;
        }
    }

    // 弹窗返回
    public static function alertBack($_info)
    {
        exit("<script type='text/javascript'>alert('$_info');history.back();</script>");
    }

    // 显示过滤
    public static function htmlString($_data)
    {
        if (is_array($_data)) {
            // 空数组则返回当前值
            if (!count($_data)) return $_data;
            foreach ($_data as $_key => $_value) {
                $_string[$_key] = Tool::htmlString($_value);
            }
        } elseif (is_object($_data)) {
            // 对象转数组用来判断值是否为空 为空则返回当前值
            if (!count(json_decode(json_encode($_data),true))) return $_data;
            foreach ($_data as $_key => $_value) {
                @$_string->$_key = Tool::htmlString($_value);
            }
        } else {
            $_string = htmlspecialchars($_data);
        }
        return $_string;
    }

    // 数据输入过滤
    public static function mysqlString($_data)
    {
        return !GPC ? addslashes($_data) : $_data;
    }

    // 清理sesson
    public static function unSession()
    {
        if (session_start()) {
            session_destroy();
        }
    }
}
