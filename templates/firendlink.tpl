<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS内容管理系统</title>
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/cast.css">
</head>
<body>
    {include file="header.tpl"}
    <div id="cast">
        <h2>调查投票</h2>
        <table cellspacing="1">
            <caption>{$vote_title}</caption>
            <tr>
                <th>投票项目</th>
                <th>图片比例</th>
                <th>百分比</th>
                <th>得票数</th>
            </tr>
            {if $vote_item}
            {foreach $vote_item(key,value)}
                <tr>
                    <td>{@value->title}</td>
                    <td style="text-align: left;"><img src="images/b{@value->picnum}.jpg" alt="" style="width: {@value->picwidth}%;height: 21px;"></td>
                    <td>{@value->percent}%</td>
                    <td>{@value->count}</td>
                </tr>
            {/foreach}
            {else}
            <tr>
                <td colspan="4">暂无数据</td>
            </tr>
            {/if}
        </table>
    </div>
    {include file='footer.tpl'}
</body>
</html>
