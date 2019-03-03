<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
    <script src="../js/admin_top_nav.js"></script>
</head>
<body id="top">
    <h1>LOGO</h1>
    <ul>
        <li><a href="../templates/sidebar.html" target="sidebar" id="nav1" class="selected" onclick="admin_top_nav(1)">首页</a></li>
        <li><a href="../templates/sidebarn.html" target="sidebar" id="nav2" onclick="admin_top_nav(2)">内容</a></li>
        <li><a href="#" target="sidebar" id="nav3" onclick="admin_top_nav(3)">会员</a></li>
        <li><a href="#" target="sidebar" id="nav4" onclick="admin_top_nav(4)">系统</a></li>
    </ul>
    <p>
        您好, <strong>admin</strong> [超级管理员] [<a href="../" target="_blank">去首页</a>] [退出]
    </p>
</body>
</html>
