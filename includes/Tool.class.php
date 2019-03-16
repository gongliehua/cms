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

    // 清理sesson
    public static function unSession()
    {
        if (session_start()) {
            session_destroy();
        }
    }
}
