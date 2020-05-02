<?php
//图像处理类
class Image{
	private $file;		//图片地址
	private $width;		//图片高度
	private $height;	//图片高度
	private $type;		//图片类型
	private $img;		//图片的资源句柄
	private $new;		//新图资源句柄

	//构造方法，初始化
	public function __construct($_file) {
		$this->file = $_SERVER['DOCUMENT_ROOT'].$_file;
		list($this->width,$this->height,$this->type) = getimagesize($this->file);
		$this->img = $this->getFromImg($this->file,$this->type);
	}

	//cke专用图像处理
	public function ckeImg($new_width = 0,$new_height = 0) {
		// 获取水印图片信息
		list($_water_width,$_water_height,$_water_type) = getimagesize(MARK);
		$_water = $this->getFromImg(MARK,$_water_type);

		if (empty($new_width) && empty($new_height)) {
			$new_width = $this->width;
			$new_height = $this->height;
		}

		if (!is_numeric($new_width) || !is_numeric($new_height)) {
			$new_width = $this->width;
			$new_height = $this->height;
		}

		//等比例
		if ($this->width > $new_width) {
			$new_height = ($new_width / $this->width) * $this->height;
		} else {
			$new_width = $this->width;
			$new_height = $this->height;
		}
		if ($this->height > $new_height) {
			$new_width = ($new_height / $this->height) * $this->width;
		} else {
			$new_width = $this->width;
			$new_height = $this->height;
		}

		//获取放水印的坐标点
		$_water_x = $new_width - $_water_width - 5;
		$_water_y = $new_height - $_water_height - 5;

		$this->new = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
		// 极小的图就不加水印了
		if ($new_width > $_water_width && $new_height > $_water_height) {
			imagecopy($this->new, $_water, $_water_x, $_water_y, 0, 0, $_water_width, $_water_height);
		}
		
		imagedestroy($_water);
	}

	//缩略图(百分比)
	public function __thumb($_per) {
		$new_width = $this->width * ($_per / 100);
		$new_height = $this->height * ($_per / 100);

		$this->new = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
	}

	//缩略图(等比例)
	public function _thumb($new_width,$new_height) {
		if ($this->width < $this->height) {
			$new_width = ($new_height / $this->height) * $this->width;
		} else {
			$new_height = ($new_width / $this->width) * $this->height;
		}

		$this->new = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
	}

	//缩略图(固定长高容器，图像等比例，扩容填充，裁剪)[固定了大小，不失真，不变形]
	public function thumb($new_width = 0,$new_height = 0) {

		if (empty($new_width) && empty($new_height)) {
			$new_width = $this->width;
			$new_height = $this->height;
		}

		if (!is_numeric($new_width) || !is_numeric($new_height)) {
			$new_width = $this->width;
			$new_height = $this->height;
		}

		//创建一个容器
		$_n_w = $new_width;
		$_n_h = $new_height;

		//创建裁剪点
		$_cut_width = 0;
		$_cut_height = 0;

		if ($this->width < $this->height) {
			$new_width = ($new_height / $this->height) * $this->width;
		} else {
			$new_height = ($new_width / $this->width) * $this->height;
		}

		if ($new_width < $_n_w) {
			$r = $_n_w / $new_width;
			$new_width *= $r;
			$new_height *= $r;
			$_cut_height = ($this->height - $_n_w) / 4;
		}

		if ($new_width < $_n_h) {
			$r = $_n_h / $new_height;
			$new_width *= $r;
			$new_height *= $r;
			$_cut_width = ($this->width - $_n_h) / 4;
		}

		$this->new = imagecreatetruecolor($_n_w, $_n_h);
		imagecopyresampled($this->new, $this->img, 0, 0, $_cut_width, $_cut_height, $new_width, $new_height, $this->width, $this->height);
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
		imagepng($this->new,$this->file);
		imagedestroy($this->img);
		imagedestroy($this->new);
	}
}
