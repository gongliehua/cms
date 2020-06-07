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
        <h2>当前位置 &gt; 搜索</h2>
        {if $SearchContent}
        {foreach $SearchContent(key,value)}
        <!-- <script type="text/javascript" src="config/static.php?type=list&id={@value->id}"></script> -->
        <dl>
            <dt><a href="details.php?id={@value->id}" target="_blank"><img src="{@value->thumbnail}" alt="{@value->title}"></a></dt>
            <dd>[<strong>{@value->nav_name}</strong>] <a href="details.php?id={@value->id}" target="_blank">{@value->t}</a></dd>
            <dd>日期: {@value->date} 点击率: {@value->count} 关键字: {@value->keyword}</dd>
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
        <div class="right">
            <h2>本月总推荐</h2>
            <ul>
                {if $MonthNavRec}
                    {foreach $MonthNavRec(key,value)}
                        <li><em>{@value->date}</em><a href="details.php?id={@value->id}">{@value->title}</a></li>
                    {/foreach}
                {/if}
            </ul>
        </div>
        <div class="right">
            <h2>本月总热点</h2>
            <ul>
                {if $MonthNavHot}
                    {foreach $MonthNavHot(key,value)}
                        <li><em>{@value->date}</em><a href="details.php?id={@value->id}">{@value->title}</a></li>
                    {/foreach}
                {/if}
            </ul>
        </div>
        <div class="right">
            <h2>本月总图文</h2>
            <ul>
                {if $MonthNavPic}
                    {foreach $MonthNavPic(key,value)}
                        <li><em>{@value->date}</em><a href="details.php?id={@value->id}">{@value->title}</a></li>
                    {/foreach}
                {/if}
            </ul>
        </div>
    </div>
    {include file='footer.tpl'}
</body>
</html>
