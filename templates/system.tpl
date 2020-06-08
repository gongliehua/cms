<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
    <script type="text/javascript" src="../js/admin_level.js"></script>
</head>
<body id="main">
    <div class="map">
        管理首页 &gt;&gt; 系统管理 &gt;&gt;<strong id="title">系统配置文件</strong>
    </div>

<form action="" method="post">
    <table cellspacing="0">
        <tr><th style="text-align: center;"><strong>系统配置信息</strong autocomplete="off"></th></tr>
        <tr><th>网站名称: <input type="text" name="webname" value="{$webname}" autocomplete="off"></th></tr>
        <tr><th>常规分页: <input type="number" name="page_size" value="{$page_size}" autocomplete="off"></th></tr>
        <tr><th>文档分页: <input type="number" name="article_size" value="{$article_size}" autocomplete="off"></th></tr>
        <tr><th>导航个数: <input type="number" name="nav_size" value="{$nav_size}" autocomplete="off"></th></tr>
        <tr><th>上传目录: <input type="text" name="updir" value="{$updir}" autocomplete="off"></th></tr>
        <tr><th>轮播速度: <input type="number" name="ro_time" value="{$ro_time}" autocomplete="off"></th></tr>
        <tr><th>轮播个数: <input type="number" name="ro_num" value="{$ro_num}" autocomplete="off"></th></tr>
        <tr><th>文字广告: <input type="number" name="adver_text_num" value="{$adver_text_num}" autocomplete="off"></th></tr>
        <tr><th>图片广告: <input type="number" name="adver_pic_num" value="{$adver_pic_num}" autocomplete="off"></th></tr>
    </table>
    <p style="margin: 20px;text-align: center;"><input type="submit" name="send" value="修改配置文件"></p>
</form>

</body>
</html>
