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
        // 生成编译文件
        $_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
        if (!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)) {
            // 引入解析类 once防止header/footer加载再次载入类报错
            require_once ROOT_PATH.'/includes/Parser.class.php';
            $_parser = new Parser($_tplFile);
            $_parser->compile($_parFile);
        }
        // 判断是否开启缓存
        $_cacheFile = CACHE_DIR.md5($_tplFile).$_file.'.html';
        if (IS_CACHE) {
            if (!file_exists($_cacheFile) || filemtime($_cacheFile) < filemtime($_parFile)) {
                include $_parFile;
                file_put_contents($_cacheFile,ob_get_contents());
                ob_end_clean();
            }
            include $_cacheFile;
        } else {
            include $_parFile;
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
