<?php

// 验证类
class Validate {
    // 是否为空
    public static function checkNull($_data)
    {
        if (trim($_data) == '') return true;
        return false;
    }

    // 长度是否合法
    public static function checkLength($_data,$_length,$_flag = null)
    {
        if ($_flag == 'min') {
            if (mb_strlen(trim($_data),'utf-8') < $_length) return true;
            return false;
        } elseif ($_flag == 'max') {
            if (mb_strlen(trim($_data),'utf-8') > $_length) return true;
            return false;
        } else {
            Tool::alertBack('ERROR：参数错误，必须是min,max');
        }
    }

    // 数据是否一致
    public static function checkEquals($_data,$_other)
    {
        if (trim($_data) != trim($_other)) return true;
        return false;
    }
}
