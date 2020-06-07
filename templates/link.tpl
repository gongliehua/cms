<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
    <script type="text/javascript" src="../js/admin_link.js"></script>
</head>
<body id="main">
    <div class="map">
        管理首页 &gt;&gt; 友情链接 &gt;&gt; <strong id="title">{$title}</strong>
    </div>

    <ol>
        <li><a href="link.php?action=show" class="selected">链接列表</a></li>
        <li><a href="link.php?action=add">新增链接</a></li>

        {if $update}
        <li><a href="link.php?action=update&id={$id}">修改链接</a></li>
        {/if}

    </ol>

    {if $show}
    <table cellspacing="0">
        <tr>
            <th>编号</th>
            <th>网站名称</th>
            <th>网站地址</th>
            <th>Logo地址</th>
            <th>站长名称</th>
            <th>类型</th>
            <th>状态</th>
            <th>操作</th>
        </tr>

        {if $AllLink}
        {foreach $AllLink(key,value)}
            <tr>
                <td>{@value->id}</td>
                <td>{@value->webname}</td>
                <td title="{@value->fullweburl}">{@value->weburl}</td>
                <td title="{@value->fulllogourl}">{@value->logourl}</td>
                <td>{@value->user}</td>
                <td>{@value->type}</td>
                <td>{@value->state}</td>
                <td><a href="link.php?action=update&id={@value->id}">编辑</a> <a href="link.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除这个链接吗？') ? true : false;">删除</a></td>
            </tr>
        {/foreach}
        {else}
            <tr>
                <td colspan="8">对不起，没有任何数据</td>
            </tr>
        {/if}

    </table>
    <div id="page">{$page}</div>
    {/if}

    {if $add}
    <form action="" method="post" name="link">
        <input type="hidden" name="state" value="1">
        <table cellspacing="0" class="left">
            <tr><td>网站类型：
                    <input type="radio" name="type" onclick="_link(1)" value="1" checked>文字链接
                    <input type="radio" name="type" onclick="_link(2)" value="2">LOGO链接
            </td></tr>
            <tr><td>网站名称：<input type="text" class="text" name="webname"><span class="reg">[必填]</span>(*不能为空，不得大于20位)</td></tr>
            <tr><td>网站地址：<input type="text" class="text" name="weburl"><span class="reg">[必填]</span>(*不能为空，网站地址不得大于100位)</td></tr>
            <tr><td style="display:none;" id="logo">LOGO地址<input type="text" class="text" name="logourl"><span class="reg">[必填]</span>(*LOGO地址不能为空 )</td></tr>
            <tr><td>站长名字：<input type="text" class="text" name="user"></td></tr>

            <tr><td><input type="submit" name="send" value="新增等级" onclick="return checkForm();" class="submit"> [ <a href="link.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

    {if $update}
    <form action="" method="post" name="add">
        <input type="hidden" name="id" value="{$id}">
        <input type="hidden" name="state" value="{$state}">
        <table cellspacing="0" class="left">
            <tr><td>网站类型：
                    <input type="radio" name="type" onclick="_link(1)" value="1" {$type_left}>文字链接
                    <input type="radio" name="type" onclick="_link(2)" value="2" {$type_right}>LOGO链接
            </td></tr>
            <tr><td>网站名称：<input type="text" class="text" value="{$webname}" name="webname"><span class="reg">[必填]</span>(*不能为空，不得大于20位)</td></tr>
            <tr><td>网站地址：<input type="text" class="text" value="{$weburl}" name="weburl"><span class="reg">[必填]</span>(*不能为空，网站地址不得大于100位)</td></tr>
            <tr><td style="{$logourl_show}" id="logo">LOGO地址<input type="text" value="{$logourl}" class="text" name="logourl"><span class="reg">[必填]</span>(*LOGO地址不能为空 )</td></tr>
            <tr><td>站长名字：<input type="text" value="{$user}" class="text" name="user"></td></tr>

            <tr><td><input type="submit" name="send" value="新增等级" onclick="return checkForm();" class="submit"> [ <a href="link.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

</body>
</html>
