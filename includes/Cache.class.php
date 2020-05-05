<?php

//静态页面句柄不缓存
class Cache
{
	//统计点击量
	public function details()
	{
		$_content = new ContentModel();
		$_content->id = $_GET['id'];
		$this->setContentCount($_content);
		$this->getContentCount($_content);
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
