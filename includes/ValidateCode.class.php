<?php

// 验证码类
class ValidateCode{
    private $charset = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789';    // 随机因子
    private $code = '';                                                             // 验证码
    private $codeLen = 4;                                                           // 长度
    private $width = 130;                                                           // 宽
    private $height = 50;                                                           // 高
    private $img;                                                                   // 图片
    private $font;                                                                  // 字体
    private $fontSize = 20;                                                         // 字体大小
    private $fontColor;                                                             // 字体颜色

    // 初始化
    public function __construct()
    {
        $this->font = ROOT_PATH.'/font/elephant.ttf';
    }

    // 生成随机码
    private function createCode()
    {
        $_len = strlen($this->charset) - 1;
        for ($i = 0; $i < $this->codeLen; $i++) {
            $this->code .= $this->charset[mt_rand(0,$_len)];
        }
        return $this->code;
    }

    // 生成背景
    private function createBg()
    {
        $this->img = imagecreatetruecolor($this->width,$this->height);
        $color = imagecolorallocate($this->img,mt_rand(157,255),mt_rand(157,255),mt_rand(157,255));
        imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
    }

    // 生成文字
    private function createFont()
    {
        $_x = $this->width / $this->codeLen;
        for ($i = 0; $i < $this->codeLen; $i++) {
            $this->fontColor = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,136));
            imagettftext($this->img,$this->fontSize,mt_rand(-30,30),$_x*$i+mt_rand(1,5),$this->height/1.4,$this->fontColor,$this->font,$this->code[$i]);
        }
    }

    // 生成线条 雪花
    private function createLine()
    {
        for ($i = 0;$i < 6;$i++) {
            $color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
        }
        for ($i = 0;$i < 100;$i++) {
            $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
            imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
        }
    }

    // 输出
    private function outPut()
    {
        header('Content-type:image/png');
        imagepng($this->img);
        imagedestroy($this->img);
    }

    // 对外输出
    public function doImg()
    {
        $this->createBg();
        $this->createCode();
        $this->createLine();
        $this->createFont();
        $this->outPut();
    }

    // 获取验证码
    public function getCode()
    {
        return strtolower($this->code);
    }
}
