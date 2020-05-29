<?php

//静态页面句柄不缓存
class Cache
{
	private $flag;

	// 构造方法
	public function __construct($_noCache)
	{
		$this->flag = in_array(Tool::tplName(), $_noCache);
	}

	// 返回不使用缓存的页面布尔值
	public function noCache()
	{
		return $this->flag;
	}

	// _action
	public function _action()
	{
		switch ($_GET['type']) {
			case 'details':
				$this->details();
				break;
			case 'list':
				$this->listc();
				break;
			case 'header':
				$this->header();
				break;
		}
	}

	//统计点击量
	public function details()
	{
		$_content = new ContentModel();
		$_content->id = $_GET['id'];
		$this->setContentCount($_content);
		$this->getContentCount($_content);
	}

	// list
	public function listc()
	{
		$_content = new ContentModel();
		$_content->id = $_GET['id'];
		$this->setContentCount($_content);
		$this->getContentCount($_content);
	}

	public function header()
	{
		$_cookie = new Cookie('user');
		if ($_cookie->getCookie()) {
			echo "function getHeader(){
	document.write('{$_cookie->getCookie()}，您好！<a href=\"register.php?action=logout\">退出</a>');
}";
		} else {
			echo 'function getHeader() {
				document.write(\'<a href="register.php?action=reg" class="user">注册</a> <a href="register.php?action=login" class="user">登录</a>\');
			}
			';
		}
	}

	//累计
	private function setContentCount(&$_content)
	{
		$_content->setContentCount();
	}

	//获取
	private function getContentCount($_content)
	{
		$_count = $_content->getOneContent()->count;
		echo "function getContentCount(){
	document.write('$_count');
}";
	}
}
