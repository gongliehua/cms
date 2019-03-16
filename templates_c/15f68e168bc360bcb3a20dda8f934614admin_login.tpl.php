<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
    <script type="text/javascript" src="../js/admin_login.js"></script>
</head>
<body>
    <form action="manage.php?action=login" method="post" name="login" id="adminLogin">
        <fieldset>
            <legend>登录CMS后台管理系统</legend>
            <label>账口号：<input type="text" name="admin_user" class="text"></label>
            <label>密口码：<input type="password" name="admin_pass" class="text"></label>
            <label>验证码：<input type="text" name="code" class="text" autocomplete="off"></label>
            <label class="t">输入验证码, 不区分大小写</label>
            <label><img src="../config/code.php" alt="captcha" onclick="javascript:this.src='../config/code.php?tm='+Math.random()"></label>
            <input type="submit" name="send" value="登录" onclick="return checkLogin();" class="submit">
        </fieldset>
    </form>
</body>
</html>
