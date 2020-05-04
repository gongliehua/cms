<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS内容管理系统</title>
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/details.css">
    <script type="text/javascript" src="config/static.php?id={$id}"></script>
</head>
<body>
    {include file="header.tpl"}
    <div id="details">
        <h2>当前位置 &gt; {$nav}</h2>
        <h3>{$titlec}</h3>
        <div class="d1">时间：{$date} 来源：{$source} 作者：{$author} 点击量：{$count}次</div>
        <div class="d2">{$info}</div>
        <div class="d3">{$content}</div>
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
