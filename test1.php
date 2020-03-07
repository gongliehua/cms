<?php

// 载入一张图片
$img = imagecreatefromjpeg('1.jpg');
list($width, $height, $type) = getimagesize('1.jpg');

$new_width = 150;
$new_height = 150;

// 等比例缩放
if ($width < $height) {
	$new_width = ($new_height / $height) * $width;
} else {
	$new_height = ($new_width / $width) * $height;
}

$new = imagecreatetruecolor($new_width, $new_height);
 
imagecopyresampled($new, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

header('Content-Type: image/jpeg');
imagejpeg($new);
imagedestroy($new);
