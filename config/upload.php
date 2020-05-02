<?php

require substr(dirname(__FILE__),0,-7).'/init.inc.php';
if (isset($_POST['send'])) {
	$_fileupload = new FileUpload('pic', $_POST['MAX_FILE_SIZE']);
	$_path = $_fileupload->getPath();
	$_img = new Image($_path);
	$_img->thumb(); //1-100
	$_img->out();
	Tool::alertOpenerClose('缩略图上传成功',$_path);
} else {
    Tool::alertBack('警告：上传失败');
}
