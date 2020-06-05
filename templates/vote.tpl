<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
    <script type="text/javascript" src="../js/admin_vote.js"></script>
</head>
<body id="main">
    <div class="map">
        管理首页 &gt;&gt; 调查投票管理 &gt;&gt; <strong id="title">{$title}</strong>
    </div>

    <ol>
        <li><a href="vote.php?action=show" class="selected">投票主题列表</a></li>
        <li><a href="vote.php?action=add">新增投票主题</a></li>

        {if $addchild}
        <li><a href="vote.php?action=addchild&id={$id}">新增投票项目</a></li>
        {/if}

        {if $showchild}
        <li><a href="vote.php?action=showchild&id={$id}">投票项目列表</a></li>
        {/if}

        {if $update}
        <li><a href="vote.php?action=update&id={$id}">修改投票主题</a></li>
        {/if}

    </ol>

    {if $show}
    <table cellspacing="0">
        <tr>
            <th>编号</th>
            <th>投票主题</th>
            <th>投票项目</th>
            <th>是否前台首选</th>
            <th>参与人数</th>
            <th>操作</th>
        </tr>

        {if $AllVote}
        {foreach $AllVote(key,value)}
            <tr>
                <td>{@value->id}</td>
                <td>{@value->title}</td>
                <td><a href="vote.php?action=showchild&id={@value->id}">查看</a> | <a href="vote.php?action=addchild&id={@value->id}">增加项目</a></td>
                <td>{@value->state}</td>
                <td>{@value->people_num}</td>
                <td><a href="vote.php?action=update&id={@value->id}">编辑</a> <a href="vote.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除这个投票主题吗？') ? true : false;">删除</a></td>
            </tr>
        {/foreach}
        {else}
            <tr>
                <td colspan="5">对不起，没有任何数据</td>
            </tr>
        {/if}

    </table>
    <div id="page">{$page}</div>
    {/if}

    {if $showchild}
    <table cellspacing="0">
        <tr>
            <th>编号</th>
            <th>投票项目</th>
            <th>得票数</th>
            <th>操作</th>
        </tr>

        {if $AllChildVote}
        {foreach $AllChildVote(key,value)}
            <tr>
                <td>{@value->id}</td>
                <td>{@value->title}</td>
                <td>{@value->count}</td>
                <td><a href="vote.php?action=update&id={@value->id}">编辑</a> <a href="vote.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除这个投票项目吗？') ? true : false;">删除</a></td>
            </tr>
        {/foreach}
        {else}
            <tr>
                <td colspan="4">对不起，没有任何数据</td>
            </tr>
        {/if}
        <tr><td colspan="4">所属主题：<strong>{$titlec}</strong> [<a href="vote.php?action=addchild&id={$id}">增加本项</a>][<a href="vote.php?action=show">返回列表</a>]</td></tr>

    </table>
    <div id="page">{$page}</div>
    {/if}

    {if $add}
    <form action="" method="post" name="add">
        <table cellspacing="0" class="left">
            <tr><td>投票主题：<input type="text" name="title" class="text"> (* 投票主题不得小于2位,不得大于20位)</td></tr>
            <tr><td><textarea name="info"></textarea> (* 描述不得大于200位)</td></tr>
            <tr><td><input type="submit" name="send" value="新增投票主题" onclick="return checkForm();" class="submit"> [ <a href="vote.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

    {if $addchild}
    <form action="" method="post" name="add">
        <table cellspacing="0" class="left">
            <input type="hidden" value="{$id}" name="id">
            <tr><td>所属主题：<strong>{$titlec}</strong></td></tr>
            <tr><td>投票项目：<input type="text" name="title" class="text"> (* 投票项目不得小于2位,不得大于20位)</td></tr>
            <tr><td><textarea name="info"></textarea> (* 描述不得大于200位)</td></tr>
            <tr><td><input type="submit" name="send" value="新增投票项目" onclick="return checkForm();" class="submit"> [ <a href="vote.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

    {if $update}
    <form action="" method="post" name="add">
        <input type="hidden" name="id" value="{$id}">
        <table cellspacing="0" class="left">
            <tr><td>投票主题：<input type="text" name="title" value="{$titlec}" class="text"> (* 投票主题不得小于2位,不得大于20位)</td></tr>
            <tr><td><textarea name="info">{$info}</textarea> (* 描述不得大于200位)</td></tr>
            <tr><td><input type="submit" name="send" value="修改投票主题" onclick="return checkForm();" class="submit"> [ <a href="vote.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

</body>
</html>
