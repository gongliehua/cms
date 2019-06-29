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
        <li><a href="nav.php?action=update&id={$id}">修改导航</a></li>
        {/if}

        {if $addChild}
            <li><a href="nav.php?action=addChild&id={$id}">新增子导航</a></li>
        {/if}

        {if $showChild}
            <li><a href="nav.php?action=showChild&id={$id}">子导航列表</a></li>
        {/if}

    </ol>

    {if $show}
    <form action="nav.php?action=sort" method="post">
    <table cellspacing="0">
        <tr>
            <th>编号</th>
            <th>导航名称</th>
            <th>描述</th>
            <th>子类</th>
            <th>操作</th>
            <th>排序</th>
        </tr>

        {if $AllNav}
        {foreach $AllNav(key,value)}
            <tr>
                <td>{@value->id}</td>
                <td>{@value->nav_name}</td>
                <td>{@value->nav_info}</td>
                <td><a href="nav.php?action=showChild&id={@value->id}">查看</a> | <a href="nav.php?action=addChild&id={@value->id}">增加子类</a></td>
                <td><a href="nav.php?action=update&id={@value->id}">编辑</a> <a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除这个导航吗？') ? true : false;">删除</a></td>
                <td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text sort"></td>
            </tr>
        {/foreach}
        <tr><td colspan="5"></td><td><input type="submit" name="send" value="排序" style="cursor:pointer;"></td></tr>
        {else}
            <tr>
                <td colspan="6">对不起，没有任何数据</td>
            </tr>
        {/if}

    </table>
    </form>
    {if $AllNav}
    <div id="page">{$page}</div>
    {/if}
    {/if}

    {if $add}
        <form action="" method="post" name="add">
            <table cellspacing="0" class="left">
                <tr><td>导航名称：<input type="text" name="nav_name" class="text"> (* 导航名称不得小于2位,不得大于20位)</td></tr>
                <tr><td><textarea name="nav_info"></textarea> (* 描述不得大于255位)</td></tr>
                <tr><td><input type="submit" name="send" value="新增导航" onclick="return checkForm();" class="submit"> [ <a href="nav.php?action=show">返回列表</a> ]</td></tr>
            </table>
        </form>
    {/if}

    {if $update}
        <form action="" method="post" name="add">
            <input type="hidden" name="id" value="{$id}">
            <table cellspacing="0" class="left">
                <tr><td>导航名称：<input type="text" name="nav_name" value="{$nav_name}" class="text"> (* 导航名称不得小于2位,不得大于20位)</td></tr>
                <tr><td><textarea name="nav_info">{$nav_info}</textarea> (* 描述不得大于255位)</td></tr>
                <tr><td><input type="submit" name="send" value="修改导航" onclick="return checkForm();" class="submit"> [ <a href="nav.php?action=show">返回列表</a> ]</td></tr>
            </table>
        </form>
    {/if}

    {if $addChild}
        <form action="" method="post" name="add">
            <input type="hidden" name="pid" value="{$id}">
            <table cellspacing="0" class="left">
                <tr><td>上级导航：<strong>{$prev_name}</strong></td></tr>
                <tr><td>导航名称：<input type="text" name="nav_name" class="text"> (* 导航名称不得小于2位,不得大于20位)</td></tr>
                <tr><td><textarea name="nav_info"></textarea> (* 描述不得大于255位)</td></tr>
                <tr><td><input type="submit" name="send" value="新增导航" onclick="return checkForm();" class="submit"> [ <a href="nav.php?action=show">返回列表</a> ]</td></tr>
            </table>
        </form>
    {/if}

    {if $showChild}
    <form action="nav.php?action=sort" method="post">
        <table cellspacing="0">
            <tr>
                <th>编号</th>
                <th>导航名称</th>
                <th>描述</th>
                <th>操作</th>
                <th>排序</th>
            </tr>

            {if $AllChildNav}
                {foreach $AllChildNav(key,value)}
                    <tr>
                        <td>{@value->id}</td>
                        <td>{@value->nav_name}</td>
                        <td>{@value->nav_info}</td>
                        <td><a href="nav.php?action=update&id={@value->id}">编辑</a> <a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除这个导航吗？') ? true : false;">删除</a></td>
                        <td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text sort"></td>
                    </tr>
                {/foreach}
                <tr><td colspan="4"></td><td><input type="submit" name="send" value="排序" style="cursor:pointer;"></td></tr>
            {else}
                <tr>
                    <td colspan="5">对不起，没有任何数据</td>
                </tr>
            {/if}
            <tr>
                <td colspan="5">本类隶属: <strong>{$prev_name}</strong> [ <a href="nav.php?action=addChild&id={$id}">增加本类</a> ] [ <a href="nav.php?action=show">返回列表</a> ]</td>
            </tr>

        </table>
        {if $AllChildNav}
            <div id="page">{$page}</div>
        {/if}
    </form>
    {/if}

</body>
</html>
