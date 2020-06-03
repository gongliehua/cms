<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
    <script type="text/javascript" src="../js/admin_manage.js"></script>
</head>
<body id="main">
    <div class="map">
        管理首页 &gt;&gt; 内容管理 &gt;&gt; <strong id="title">{$title}</strong>
    </div>

    <ol>
        <li><a href="comment.php?action=show" class="selected">评论列表</a></li>
    </ol>

    {if $show}
    <form action="?action=states" method="post">
    <table cellspacing="0">
        <tr>
            <th>编号</th>
            <th>评论内容</th>
            <th>评论者</th>
            <th>所属文档</th>
            <th>状态</th>
            <th>批审</th>
            <th>操作</th>
        </tr>

        {if $CommentList}
        {foreach $CommentList(key,value)}
            <tr>
                <td>{@value->id}</td>
                <td title="{@value->full}">{@value->content}</td>
                <td>{@value->user}</td>
                <td><a href="../details.php?id={@value->cid}" target="_blank" title="{@value->title}">查看</a></td>
                <td>{@value->state}</td>
                <td><input type="text" name="states[{@value->id}]" value="{@value->num}" class="text sort"></td>
                <td><a href="comment.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除这个评论吗？') ? true : false;">删除</a></td>
            </tr>
        {/foreach}
        <tr><td colspan="5"></td><td><input type="submit" name="send" value="批审" style="cursor:pointer;"></td><td></td></tr>
        {else}
            <tr>
                <td colspan="7">对不起，没有任何数据</td>
            </tr>
        {/if}
    </table>
    </form>
    {if $CommentList}
    <div id="page">{$page}</div>
    {/if}
    {/if}

</body>
</html>
