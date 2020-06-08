<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$webname}</title>
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/reg.css">
    <script type="text/javascript" src="js/reg.js"></script>
</head>
<body>
    {include file="header.tpl"}

    {if $reg}
    <div id="reg">
        <h2>会员注册</h2>
        <form action="?action=reg" method="post" name="reg">
            <dl>
                <dd>用户名口：<input type="text" class="text" name="user"><span class="reg">[必填]</span>(*用户名在2到20位之间)</dd>
                <dd>密口口码：<input type="text" class="text" name="pass"><span class="reg">[必填]</span>(*密码不得小于20位)</dd>
                <dd>密码确认：<input type="text" class="text" name="notpass"><span class="reg">[必填]</span>(*密码和确认密码必须一致 )</dd>
                <dd>电子邮件：<input type="text" class="text" name="email"><span class="reg">[必填]</span>(*每个电子邮箱只能注册一个ID)</dd>
                <dd>选择头像：
                    <select name="face" id="" onchange="sface()">
                        {foreach $OptionFaceOne(key,value)}
                        <option value="0{@value}.gif">0{@value}.gif</option>
                        {/foreach}
                        {foreach $OptionFaceTwo(key,value)}
                        <option value="{@value}.gif">{@value}.gif</option>
                        {/foreach}
                    </select>
                </dd>
                <dd><img name="faceimg" src="images/01.gif" class="face" alt="01.gif"></dd>
                <dd>安全问题：
                    <select name="question">
                        <option value="">沒有任何安全问题</option>
                        <option value="您父亲的姓名？">您父亲的姓名？</option>
                        <option value="您母亲的职业？">您母亲的职业？</option>
                        <option value="您配偶的性别？">您配偶的性别？</option>
                    </select>
                </dd>
                <dd>问题答案：<input type="text" class="text" name="answer"></dd>
                <dd>验证码口：<input type="text" class="text" name="code" autocomplete="off"><span class="reg">[必填]</span></dd>
                <dd><img src="config/code.php" alt="captcha" onclick="javascript:this.src='../config/code.php?tm='+Math.random()" class="code"></dd>
                <dd><input type="submit" class="submit" onclick="return checkReg()" name="send" value="注册会员"></dd>
            </dl>
        </form>
    </div>
    {/if}
    {if $login}
    <div id="reg">
        <h2>会员登录</h2>
        <form action="?action=login" method="post" name="login">
            <dl>
                <dd>用户名：<input type="text" class="text" name="user"><span class="reg">[必填]</span>(*用户名在2到20位之间)</dd>
                <dd>密口码：<input type="text" class="text" name="pass"><span class="reg">[必填]</span>(*密码不得小于20位)</dd>
                <td>登录保留：
                    <input type="radio" name="time" value="86400" checked>一天
                    <input type="radio" name="time" value="604800">一周
                    <input type="radio" name="time" value="2592000">一月
                </td>
                <dd>验证码：<input type="text" class="text" name="code" autocomplete="off"><span class="reg">[必填]</span></dd>
                <dd><img src="config/code.php" alt="captcha" onclick="javascript:this.src='../config/code.php?tm='+Math.random()" class="code"></dd>
                <dd><input type="submit" class="submit" onclick="return checkLogin()" name="send" value="会员登录"></dd>
            </dl>
        </form>
    </div>
    {/if}

    {include file='footer.tpl'}
</body>
</html>
