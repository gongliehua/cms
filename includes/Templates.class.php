<?php

// 模板类
class Templates {
    // 储存变量
    private $_vars = [];

    // 储存系统变量
    private $_config = [];

    // 初始化
    public function __construct()
    {
        if (!is_dir(TPL_DIR) || !is_dir(TPL_C_DIR) || !is_dir(CACHE_DIR)) {
            exit('ERROR: 模板目录或编译目录或缓存目录不存在');
        }
        // 解析系统变量
        $_sxe  = simplexml_load_file(ROOT_PATH.'/config/profile.xml');
        $_tagLib  = $_sxe->xpath('/root/taglib');
        foreach ($_tagLib as $value) {
            $this->_config["$value->name"] = $value->value;
        }
    }

    // 注入变量
    public function assign($_var,$_value)
    {
        if (isset($_var) && isset($_value)) {
            $this->_vars[$_var] = $_value;
        } else {
            exit('ERROR: 请设置模板变量');
        }
    }

    // cache方法,跳转到缓存文件,不执行PHP,不连接数据库
    public function cache($_file)
    {
        // 模板文件
        $_tplFile = TPL_DIR.$_file;
        if (!file_exists($_tplFile)) {
            exit('ERROR: 模板文件不存在');
        }
        // 是否加入参数
        if (!empty($_SERVER['QUERY_STRING'])) {
            $_file .= $_SERVER['QUERY_STRING'];
        }
        //编译文件
        $_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
        //缓存文件
        $_cacheFile = CACHE_DIR.md5($_tplFile).$_file.'.html';
        //当第二次运行相同文件的时候,直接载入缓存文件，避开编译
        if (FRONT_CACHE) {
            //缓存文件和编译文件都要存在
            if (file_exists($_cacheFile) && file_exists($_parFile)) {
                //判断模板文件是否被修改过，判断编译文件是否修改过
                if (filemtime($_parFile) >= filemtime($_tplFile) && filemtime($_cacheFile) >= filemtime($_parFile)) {
                    //载入缓存文件
                    include $_cacheFile;
                    exit();
                }
            }
        }
    }

    // 获取模板
    public function display($_file)
    {
        // 模板文件
        $_tplFile = TPL_DIR.$_file;
        if (!file_exists($_tplFile)) {
            exit('ERROR: 模板文件不存在');
        }
        // 是否加入参数
        if (!empty($_SERVER['QUERY_STRING'])) {
            $_file .= $_SERVER['QUERY_STRING'];
        }
        //编译文件
        $_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
        //缓存文件
        $_cacheFile = CACHE_DIR.md5($_tplFile).$_file.'.html';
        
        //当编译文件不存在,或者模板文件修改过,则生成编译文件
        if (!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)) {
            //引入模板解析类
            require_once ROOT_PATH.'/includes/Parser.class.php';
            $_parser = new Parser($_tplFile);//模板文件
            $_parser->compile($_parFile);//编译文件

        }
        //载入编译文件
        include $_parFile;
        if (FRONT_CACHE) {
            // 获取缓冲区的数据，并穿件缓存文件
            file_put_contents($_cacheFile, ob_get_contents());
            // 清空缓存区
            ob_end_clean();
            // 载入缓存文件
            include $_cacheFile;
        }
    }

    // 用于header和footer这种模块
    public function create($_file)
    {
        // 模板文件
        $_tplFile = TPL_DIR.$_file;
        if (!file_exists($_tplFile)) {
            exit('ERROR: 模板文件不存在');
        }
        // 生成编译文件
        $_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
        if (!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)) {
            // 引入解析类 once防止header/footer加载再次载入类报错
            require_once ROOT_PATH.'/includes/Parser.class.php';
            $_parser = new Parser($_tplFile);
            $_parser->compile($_parFile);
        }
        include $_parFile;
    }
}
