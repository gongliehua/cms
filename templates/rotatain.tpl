<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
    <script type="text/javascript" src="../js/admin_rotatain.js"></script>
</head>
<body id="main">
    <div class="map">
        管理首页 &gt;&gt; 内容管理 &gt;&gt; <strong id="title">{$title}</strong>
    </div>

    <ol>
        <li><a href="rotatain.php?action=show" class="selected">轮播器列表</a></li>
        <li><a href="rotatain.php?action=add">新增轮播器</a></li>

        {if $update}
        <li><a href="rotatain.php?action=update&id={$id}">修改轮播器</a></li>
        {/if}

    </ol>

    {if $show}
    <table cellspacing="0">
        <tr>
            <th>编号</th>
            <th>标题</th>
            <th>链接</th>
            <th>是否首页轮播</th>
            <th>操作</th>
        </tr>

        {if $AllRotatain}
        {foreach $AllRotatain(key,value)}
            <tr>
                <td>{@value->id}</td>
                <td>{@value->title}</td>
                <td><a href="{@value->full}" target="_blank">{@value->link}</a></td>
                <td>{@value->state}</td>
                <td><a href="rotatain.php?action=update&id={@value->id}">查看并编辑</a> <a href="rotatain.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除这个轮播器吗？') ? true : false;">删除</a></td>
            </tr>
        {/foreach}
        <tr>
            <td colspan="5" style="color: blue;">(*每当任何轮播器的操作或变动，都必须更新首页轮播器*)</td>
        </tr>
        <tr>
            <td colspan="5" style="color: blue;"><input type="button" value="生成XML文件" onclick="location.href='?action=xml'"></td>
        </tr>
        {else}
            <tr>
                <td colspan="5">对不起，没有任何数据</td>
            </tr>
        {/if}

    </table>
    {if $AllManage}
    <div id="page">{$page}</div>
    {/if}
    {/if}

    {if $add}
    <form action="" method="post" name="content">
        <table cellspacing="0" class="left">
            <tr><td>轮播图：
                    <input type="text" name="thumbnail" readonly class="text">
                    <input type="button" value="上传轮播图" onclick="centerWindow('../config/upfile.php?type=rotatain','upfile','600','180')">
                    <img src="" name="pic" style="display: none;" alt="">(* 最佳尺寸698x193,必须是jpg,gif,png，并且200kb内)
            </td></tr>
            <tr><td>链口接：<input type="text" name="link" class="text"> (* 不得为空)</td></tr>
            <tr><td>标口题：<input type="text" name="title" class="text"> (* 不得大于20位)</td></tr>
            <tr><td><textarea name="info"></textarea></td></tr>

            <tr><td><input type="submit" name="send" value="新增轮播图" onclick="return checkAddRotatain();" class="submit"> [ <a href="rotatain.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

    {if $update}
    <form action="" method="post" name="content">
        <input type="hidden" name="id" value="{$id}">
        <table cellspacing="0" class="left">
            <tr><td>轮播图：
                    <input type="text" name="thumbnail" readonly class="text" value="{$thumbnail}">
                    <input type="button" value="上传轮播图" onclick="centerWindow('../config/upfile.php?type=rotatain','upfile','600','180')">
                    <img src="{$thumbnail}" name="pic" style="display: block;" alt="">(* 最佳尺寸698x193,必须是jpg,gif,png，并且200kb内)
            </td></tr>
            <tr><td>链口接：<input type="text" value="{$link}" name="link" class="text"> (* 不得为空)</td></tr>
            <tr><td>标口题：<input type="text" value="{$titlec}" name="title" class="text"> (* 不得大于20位)</td></tr>
            <tr><td>轮口播：
                            <input type="radio" name="state" value="1" {$left_state}> 是
                            <input type="radio" name="state" value="0" {$right_state}> 否
            </td></tr>
            <tr><td><textarea name="info">{$info}</textarea></td></tr>
            <tr><td><input type="submit" name="send" value="修改轮播图" onclick="return checkAddRotatain();" class="submit"> [ <a href="rotatain.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

</body>
</html>
