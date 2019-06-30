<?php

// 上传文件类
class FileUpload
{
	// 目录路径
	private $path;

	// 今天目录
	private $today;

	// 错误代码
	private $error;

	// 表单最大值
	private $maxsize;

	// 类型
	private $type;

	// 类型合集
	private $typeArr = ['image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif'];

	// 文件名
	private $name;

	// 临时文件
	private $tmp;

	// 连接路径
	private $linkpath;

	// 构造方法
	public function __construct($_file, $_maxsize)
	{
		$this->error = isset($_FILES[$_file]['error']) ? $_FILES[$_file]['error'] : 4;
		$this->maxsize = $_maxsize/1024;
		$this->type = $_FILES[$_file]['type'];
		$this->path = ROOT_PATH.UPDIR;
		$this->today = $this->path.date('Ymd/');
		$this->name = $_FILES[$_file]['name'];
		$this->tmp = $_FILES[$_file]['tmp_name'];
		$this->checkPath();
		$this->checkError();
		$this->checkType();
		$this->moveUpload();
	}

	// 验证目录
	private function checkPath()
	{
		if (is_dir($this->today)) {
			if (!is_writeable($this->today)) {
				Tool::alertBack('警告: 上传目录不可写,请联系管理员！');
			}
		} else {
			if (!mkdir($this->today, 0777, true)) {
				Tool::alertBack('警告: 创建上传目录失败！');
			}
		}
	}

	// 验证错误
	private function checkError()
	{
		if (!empty($this->error)) {
			switch ($this->error) {
				case 1:
					Tool::alertBack('警告: 上传值超过了约定最大值！');
					break;
				case 2:
					Tool::alertBack('警告: 上传值超过了'.$this->maxsize.'KB！');
					break;
				case 3:
					Tool::alertBack('警告: 只有部分文件被上传！');
					break;
				case 4:
					Tool::alertBack('警告: 没有任何文件被上传！');
					break;
				default:
					Tool::alertBack('警告: 上传文件未知错误！');
					break;
			}
		}
	}

	// 验证类型
	private function checkType()
	{
		if (!in_array($this->type, $this->typeArr)) {
			Tool::alertBack('警告: 不合法的上传文件类型！');
		}
	}

	// 设置新文件名
	private function setNewName()
	{
		$_nameArr = explode('.', $this->name);
		$_postfix = end($_nameArr);
		$_newname = date('YmdHis').mt_rand(100,1000).'.'.$_postfix;
		return $this->linkpath = $this->today.$_newname;
	}

	// 移动文件
	private function moveUpload()
	{
		if (is_uploaded_file($this->tmp)) {
			if (!move_uploaded_file($this->tmp, $this->setNewName())) {
				Tool::alertBack('警告: 上传失败！');
			}
		} else {
			Tool::alertBack('警告: 临时文件不存在！');
		}
	}

	// 返回路径
	public function getPath()
	{
		return $this->linkpath;
	}
}
