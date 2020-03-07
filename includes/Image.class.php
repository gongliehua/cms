<?php
//图像处理类
class Image{
	private $file;		//图片地址
	private $width;		//图片高度
	private $height;	//图片高度
	private $type;		//图片类型
	private $img;		//图片的资源句柄

	//构造方法，初始化
	public function __construct($_file) {
		$this->file = $_SERVER['DOCUMENT_ROOT'].$_file;
		list($this->width,$this->height,$this->type) = getimagesize($this->file);
		$this->img = $this->getFromImg($this->file,$this->type);
	}

	//加载图片，各种类型，返回图片的资源句柄
	private function getFromImg($_file,$_type) {
		switch($_type) {
			case 1:
				$img = imagecreatefromgif($_file);
				break;
			case 2:
				$img = imagecreatefromjpeg($_file);
				break;
			case 3:
				$img = imagecreatefrompng($_file);
				break;
			default:
				Tool::alertBack('警告：此图片类型笨系统不支持');
		}
		return $img;
	}

	//图像输出
	public function out() {
		imagepng($this->img,$this->file);
		imagedestroy($this->img);
	}
}
