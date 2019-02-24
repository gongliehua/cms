<?php

// 解析类
class Parser {

    // 模板文件内容
    private $_tpl;

    // 读取模板文件
    public function __construct($_tplFile)
    {
        if (!$this->_tpl = file_get_contents($_tplFile)) {
            exit('ERROR: 模板文件读取错误');
        }
    }

    // 解析变量
    public function parVar()
    {
        $_patten = '/\{\$([\w]+)\}/';
        if (preg_match($_patten,$this->_tpl)) {
            $this->_tpl = preg_replace($_patten,"<?php echo \$this->_vars['$1']; ?>",$this->_tpl);
        }
    }

    // 解析if语句
    public function parIf()
    {
        $_pattenIf = '/\{if\s+\$([\w]+)\}/';
        $_pattenEndIf = '/{\/if\}/';
        $_pattenElse = '/\{else\}/';
        if (preg_match($_pattenIf,$this->_tpl)) {
            if (preg_match($_pattenEndIf,$this->_tpl)) {
                $this->_tpl = preg_replace($_pattenIf,"<?php if (\$this->_vars['$1']) { ?>",$this->_tpl);
                $this->_tpl = preg_replace($_pattenEndIf,"<?php } ?>",$this->_tpl);
                if (preg_match($_pattenElse,$this->_tpl)) {
                    $this->_tpl = preg_replace($_pattenElse,"<?php } else { ?>",$this->_tpl);
                }
            } else {
                exit('ERROR: if语句没有关闭');
            }
        }
    }

    // 解析foreach语句
    public function parForeach()
    {
        $_pattenForeach = '/\{foreach\s+\$([\w]+)\(([\w]+),([\w]+)\)\}/';
        $_pattenEndForeach = '/\{\/foreach\}/';
        $_pattenVar = '/\{@([\w]+)\}/';
        if (preg_match($_pattenForeach,$this->_tpl)) {
            if (preg_match($_pattenEndForeach,$this->_tpl)) {
                $this->_tpl = preg_replace($_pattenForeach,"<?php foreach (\$this->_vars['$1'] as \$$2=>\$$3) { ?>",$this->_tpl);
                $this->_tpl = preg_replace($_pattenEndForeach,"<?php } ?>",$this->_tpl);
                if (preg_match($_pattenVar,$this->_tpl)) {
                    $this->_tpl = preg_replace($_pattenVar,"<?php echo \$$1; ?>",$this->_tpl);
                }
            } else {
                exit('ERROR: foreach语句没有关闭');
            }
        }
    }

    // 解析include语句
    public function parInclude()
    {
        $_patten = '/\{include\s+file=(\"|\')([\w\.\-\/]+)(\"|\')\}/';
        if (preg_match($_patten,$this->_tpl,$_file)) {
            if (!isset($_file[2]) || !file_exists($_file[2])) {
                exit('ERROR: 包含文件出错');
            }
            $this->_tpl = preg_replace($_patten,"<?php include '$2'; ?>",$this->_tpl);
        }
    }

    // 解析注释
    public function parCommon()
    {
        $_patten = '/\{#\}(.*)\{#\}/';
        if (preg_match($_patten,$this->_tpl)) {
            $this->_tpl = preg_replace($_patten,"<?php /* $1 */ ?>",$this->_tpl);
        }
    }

    // 解析系统变量
    public function parConfig()
    {
        $_patten = '/<!--\{([\w]+)\}-->/';
        if (preg_match($_patten,$this->_tpl)) {
            $this->_tpl = preg_replace($_patten,"<?php echo \$this->_config['$1']; ?>",$this->_tpl);
        }
    }

    // 对外公共方法
    public function compile($_parFile)
    {
        $this->parVar();
        $this->parIf();
        $this->parForeach();
        $this->parInclude();
        $this->parCommon();
        $this->parConfig();
        if (!file_put_contents($_parFile,$this->_tpl)) {
            exit('ERROR: 编译文件生成出错');
        }
    }
}
