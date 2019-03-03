<?php

//工具类
class Tool {
    // 弹窗跳转
    public static function alertLocation($_info,$_url)
    {
        exit("<script type='text/javascript'>alert('$_info');location.href='$_url';</script>");
    }

    // 弹窗返回
    public static function alertBack($_info)
    {
        exit("<script type='text/javascript'>alert('$_info');history.back();</script>");
    }
}
