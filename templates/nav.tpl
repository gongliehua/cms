<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
    <script type="text/javascript" src="../js/admin_nav.js"></script>
</head>
<body id="main">
    <div class="map">
        内容管理 &gt;&gt; 设置网站导航 &gt;&gt; <strong id="title">{$title}</strong>
    </div>

    <ol>
        <li><a href="nav.php?action=show" class="selected">导航列表</a></li>
        <li><a href="nav.php?action=add">新增导航</a></li>

        {if $update}
        <li><a href="nav.php?action=update&id=">修改导航</a></li>
        {/if}

    </ol>

    {if $show}
    <table cellspacing="0">
        <tr>
            <th>编号</th>
            <th>导航名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>

        {if $AllNav}
        {foreach $AllNav(key,value)}
            <tr>
                <td>{@value->id}</td>
                <td>{@value->nav_name}</td>
                <td>{@value->nav_info}</td>
                <td><a href="nav.php?action=update&id={@value->id}">编辑</a> <a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除这个导航吗？') ? true : false;">删除</a></td>
            </tr>
        {/foreach}
        {else}
            <td colspan="4">对不起，没有任何数据</td>
        {/if}

    </table>
    <div id="page">{$page}</div>
    {/if}

</body>
</html>
