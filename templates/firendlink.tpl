<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$webname}</title>
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/firendlink.css">
    <script src="js/link.js"></script>
</head>
<body>
    {include file="header.tpl"}
    {if $frontadd}
    <div id="firendlink">
        <h2>申请友情链接</h2>
        <form action="?action=frontadd" method="post" name="link">
            <input type="hidden" name="state" value="0">
            <dl>
                <dd>网站类型：
                        <input type="radio" name="type" onclick="_link(1)" value="1" checked>文字链接
                        <input type="radio" name="type" onclick="_link(2)" value="2">LOGO链接
                </dd>
                <dd>网站名称：<input type="text" class="text" name="webname"><span class="reg">[必填]</span>(*不能为空，不得大于20位)</dd>
                <dd>网站地址：<input type="text" class="text" name="weburl"><span class="reg">[必填]</span>(*不能为空，网站地址不得大于100位)</dd>
                <dd style="display:none;" id="logo">LOGO地址<input type="text" class="text" name="logourl"><span class="reg">[必填]</span>(*LOGO地址不能为空 )</dd>
                <dd>站长名字：<input type="text" class="text" name="user"></dd>
                <dd>验证码口：<input type="text" class="text" name="code" autocomplete="off"><span class="reg">[必填]</span></dd>
                <dd><img src="config/code.php" alt="captcha" onclick="javascript:this.src='../config/code.php?tm='+Math.random()" class="code"></dd>
                <dd><input type="submit" class="submit" onclick="return checkForm()" name="send" value="申请友情链接"></dd>
            </dl>
    </div>
    {/if}
    {if $frontshow}
    <div id="firendlink">
        <h2>所有连接</h2>
        <h3>文字链接</h3>
        <div>
            {if $AllText}
            {foreach $AllText(key,value)}
            <a href="{@value->weburl}" target="_blank">{@value->webname}</a>
            {/foreach}
            {/if}
        </div>
        <h3>LOGO链接</h3>
        <div>
            {if $AllLogo}
            {foreach $AllLogo(key,value)}
            <a href="{@value->weburl}" target="_blank"><img src="{@value->logourl}" alt="{@value->webname}"></a>
            {/foreach}
            {/if}
        </div>
    </div>
    {/if}

    {include file='footer.tpl'}
</body>
</html>
