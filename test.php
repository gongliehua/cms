<?php

// 载入一张图片
$img = imagecreatefromjpeg('1.jpg');
// 获取图片信息
list($width, $height, $type) = getimagesize('1.jpg');


// 百分比缩放
$per = 0.5;
// 创建一张新图片
$new_width = $width * $per;
$new_height = $height * $per;
// 创建一张以黑色背景的图像
$new = imagecreatetruecolor($new_width, $new_height);

/**
 * 拷贝部分图像到新图像上面（imagecopyresized/imagecopyresampled 后者是高清的）
 * 新的图像资源,旧的图像资源,新的坐标,旧的坐标,新的宽高,旧的宽高
 */
imagecopyresampled($new, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

header('Content-Type: image/jpeg');
imagejpeg($new);
imagedestroy($new);