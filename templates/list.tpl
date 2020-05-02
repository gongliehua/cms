<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS内容管理系统</title>
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/list.css">
</head>
<body>
    {include file="header.tpl"}
    <div id="list">
        <h2>当前位置 &gt; {$nav}</h2>
        {if $AllListContent}
        {foreach $AllListContent(key,value)}
        <dl>
            <dt><img src="{@value->thumbnail}" alt="{@value->title}"></dt>
            <dd>[<strong>{@value->nav_name}</strong>] <a href="#">{@value->title}</a></dd>
            <dd>日期: {@value->date} 点击率: {@value->count} 好评: 0</dd>
            <dd>核心提示：{@value->info}</dd>
        </dl>
        {/foreach}
        {else}
        <p class="none">没有任何数据</p>
        {/if}
        <div id="page">
            {$page}
        </div>
    </div>
    <div id="sidebar">
        <div class="nav">
            <h2>子栏目列表</h2>
            {if $childNav}
                {foreach $childNav(key,value)}
                    <strong><a href="/list.php?id={@value->id}">{@value->nav_name}</a></strong>
                {/foreach}
            {else}
                <span>该栏目没有子类</span>
            {/if}
        </div>
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
