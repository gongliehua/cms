<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
</head>
<body id="main">
    <div class="map">
        管理首页 &gt;&gt; 后台首页
    </div>

    <table cellspacing="0">
    	<tr><th><strong>快捷操作</strong></th></tr>
    	<tr><td><input type="button" value="清理缓存" onclick="location.href='main.php?action=delcache'">(缓存目录现有<strong>{$cacheNum}</strong>个文件)</td></tr>
    </table>
</body>
</html>
