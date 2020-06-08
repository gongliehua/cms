<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
    <script type="text/javascript" src="../js/admin_permission.js"></script>
</head>
<body id="main">
    <div class="map">
        管理首页 &gt;&gt; 权限管理 &gt;&gt; <strong id="title">{$title}</strong>
    </div>

    <ol>
        <li><a href="permission.php?action=show" class="selected">权限列表</a></li>
        <li><a href="permission.php?action=add">新增权限</a></li>

        {if $update}
        <li><a href="permission.php?action=update&id={$id}">修改权限</a></li>
        {/if}

    </ol>

    {if $show}
    <table cellspacing="0">
        <tr>
            <th>编号</th>
            <th>权限名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>

        {if $AllPermission}
        {foreach $AllPermission(key,value)}
            <tr>
                <td>{@value->id}</td>
                <td>{@value->name}</td>
                <td title="{@value->fullinfo}">{@value->info}</td>
                <td><a href="permission.php?action=update&id={@value->id}">编辑</a> <a href="permission.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除这个权限吗？') ? true : false;">删除</a></td>
            </tr>
        {/foreach}
        {else}
            <tr>
                <td colspan="4">对不起，没有任何数据</td>
            </tr>
        {/if}

    </table>
    {/if}

    {if $add}
    <form action="" method="post" name="add">
        <table cellspacing="0" class="left">
            <tr><td>权限名称：<input type="text" name="name" class="text"> (* 等级名称不得小于2位,不得大于100位)</td></tr>
            <tr><td><textarea name="info"></textarea> (* 描述不得大于200位)</td></tr>
            <tr><td><input type="submit" name="send" value="新增权限" onclick="return checkForm();" class="submit"> [ <a href="permission.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

    {if $update}
    <form action="" method="post" name="add">
        <input type="hidden" name="id" value="{$id}">
        <table cellspacing="0" class="left">
            <tr><td>权限名称：<input type="text" name="name" value="{$name}" class="text"> (* 等级名称不得小于2位,不得大于100位)</td></tr>
            <tr><td><textarea name="info">{$info}</textarea> (* 描述不得大于200位)</td></tr>
            <tr><td><input type="submit" name="send" value="修改权限" onclick="return checkForm();" class="submit"> [ <a href="permission.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

</body>
</html>
