<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS内容管理系统</title>
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/feedback.css">
    <script type="text/javascript" src="js/details.js"></script>
</head>
<body>
    {include file="header.tpl"}
    <div id="feedback">
        <h2>评论列表</h2>
        <h3>{$titlec}</h3>
        <p class="info">{$info} <a href="details.php?id={$id}" target="_blank">[详情]</a></p>

        {if $HotThreeComment}
        {foreach $HotThreeComment(key,value)}
        <dl>
            <dt><img src="images/{@value->face}" alt="{@value->user}"></dt>
            <dd><em>{@value->date}</em><span>[{@value->user}]</span><img src="images/hot.gif" alt="最热"></dd>
            <dd class="info">[{@value->manner}]{@value->content}</dd>
            <dd class="bottom"><a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain">[{@value->sustain}]支持</a> <a href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose">[{@value->oppose}]反对</a></dd>
        </dl>
        {/foreach}
        {/if}

        <h4>最新评论</h4>
        {if $AllComment}
        {foreach $AllComment(key,value)}
        <dl>
            <dt><img src="images/{@value->face}" alt="{@value->user}"></dt>
            <dd><em>{@value->date}</em><span>[{@value->user}]</span></dd>
            <dd class="info">[{@value->manner}]{@value->content}</dd>
            <dd class="bottom"><a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain">[{@value->sustain}]支持</a> <a href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose">[{@value->oppose}]反对</a></dd>
        </dl>
        {/foreach}
        {else}
        <dl>
            <dd>此文档没有任何评论！</dd>
        </dl>
        {/if}
        <div id="page">
            {$page}
        </div>
    </div>
    <div id="sidebar">
        <h2>热评文档总排行</h2>
        <ul>
            {if $HotTwentyComment}
                {foreach $HotTwentyComment(key,value)}
                    <li><em></em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
                {/foreach}
            {/if}
        </ul>
    </div>
    <div class="d5">
        <form action="feedback.php?cid={$cid}&current=true" name="comment" method="post">
        <p>你对本文的态度：
            <input type="radio" name="manner" value="1">支持
            <input type="radio" name="manner" value="0" checked>中立
            <input type="radio" name="manner" value="-1">反对
        </p>
        <p class="red">请不要发表关于政治、反动、色情之类的评论。</p>
        <p><textarea name="content"></textarea></p>
        <p style="position: relative;top: 5px;">
            验证码：<input type="text" class="text" name="code">
            <img src="config/code.php" alt="captcha" onclick="javascript:this.src='config/code.php?tm='+Math.random()" class="code">
            <input type="submit" class="submit" onclick="return checkComment()" name="send" value="提交评论">
        </p>
        </form>
    </div>
    {include file='footer.tpl'}
</body>
</html>
