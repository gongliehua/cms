<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS内容管理系统</title>
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/details.css">
    <script type="text/javascript" src="config/static.php?id={$id}&type=details"></script>
    <script type="text/javascript" src="js/details.js"></script>
</head>
<body>
    {include file="header.tpl"}
    <div id="details">
        <h2>当前位置 &gt; {$nav}</h2>
        <h3>{$titlec}</h3>
        <div class="d1">时间：{$date} 来源：{$source} 作者：{$author} 点击量：{$count}次</div>
        <div class="d2">{$info}</div>
        <div class="d3">{$content}</div>
        <div class="d4">TAB标签：{$tag}</div>
        <div class="d6">
            <h2>
                <a href="feedback.php?cid={$id}" target="_blank">已有<span>{$comment}</span>人参与评论</a>
                最新评论
            </h2>
            {if $NewThreeComment}
            {foreach $NewThreeComment(key,value)}
            <dl>
                <dt><img src="images/{@value->face}" alt="{@value->user}"></dt>
                <dd><em>{@value->date}</em><span>[{@value->user}]</span></dd>
                <dd class="info">[{@value->manner}]{@value->content}</dd>
                <dd class="bottom"><a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain" target="_blank">[{@value->sustain}]支持</a> <a href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose" target="_blank">[{@value->oppose}]反对</a></dd>
            </dl>
            {/foreach}
            {else}
            <dl>
                <dd>此文档没有任何评论！</dd>
            </dl>
            {/if}
        </div>
        <div class="d5">
            <form action="feedback.php?cid={$id}" name="comment" method="post" target="_blank">
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
    </div>
    <div id="sidebar">
        <div class="right">
            <h2>本类推荐</h2>
            <ul>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            </ul>
        </div>
        <div class="right">
            <h2>本类热点</h2>
            <ul>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            </ul>
        </div>
        <div class="right">
            <h2>本类图文</h2>
            <ul>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            </ul>
        </div>
    </div>
    {include file='footer.tpl'}
</body>
</html>
