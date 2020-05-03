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

    // 弹窗赋值关闭(上传专用)
    public static function alertOpenerClose($_info,$_path)
    {
        echo "<script type='text/javascript'>alert('$_info');</script>";
        echo "<script type='text/javascript'>opener.document.content.thumbnail.value='$_path';</script>";
        echo "<script type='text/javascript'>opener.document.content.pic.style.display='block';</script>";
        echo "<script type='text/javascript'>opener.document.content.pic.src='$_path';</script>";
        echo "<script type='text/javascript'>window.close();</script>";
        exit;
    }

    //将html字符串转换成html标签
    public static function unHtml($_str) {
        return htmlspecialchars_decode($_str);
    }

    //将对象数组转换成字符串,并去掉最后的逗号
    public static function objArrOfStr($_object,$_field)
    {
        $_html = '';
        if ($_object) {
            foreach ($_object as $_value) {
                $_html .= $_value->$_field.',';
            }
        }
        return substr($_html,0,strlen($_html)-1);
    }

    //字符串截取
    public static function subStr($_object, $_field, $_length,$_encoding)
    {
        if ($_object) {
            foreach ($_object as $_value) {
                if (mb_strlen($_value->$_field,$_encoding) > $_length) {
                    $_value->$_field = mb_substr($_value->$_field,0,$_length,$_encoding).'...';
                }
            }
        }
        return $_object;
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
        if (is_array($_data)) {
            $_result = array_map(array('Tool', 'mysqlString'), $_data);
        } else {
            $_result= !GPC ? addslashes($_data) : $_data;
        }
        return $_result;
    }

    // 清理sesson
    public static function unSession()
    {
        if (session_start()) {
            session_destroy();
        }
    }
}
