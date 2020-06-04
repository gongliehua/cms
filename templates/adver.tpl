<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
    <script type="text/javascript" src="../js/admin_adver.js"></script>
</head>
<body id="main">
    <div class="map">
        管理首页 &gt;&gt; 内容管理 &gt;&gt; <strong id="title">{$title}</strong>
    </div>

    <ol>
        <li><a href="adver.php?action=show" class="selected">广告列表</a></li>
        <li><a href="adver.php?action=add">新增广告</a></li>

        {if $update}
        <li><a href="adver.php?action=update&id={$id}">修改广告</a></li>
        {/if}

    </ol>

    {if $show}
    <table cellspacing="0">
        <tr>
            <th>编号</th>
            <th>广告标题</th>
            <th>广告链接</th>
            <th>广告类型</th>
            <th>是否前台广告</th>
            <th>操作</th>
        </tr>

        {if $AllAdver}
        {foreach $AllAdver(key,value)}
            <tr>
                <td>{@value->id}</td>
                <td>{@value->title}</td>
                <td>{@value->link}</td>
                <td>{@value->type}</td>
                <td>{@value->state}</td>
                <td><a href="adver.php?action=update&id={@value->id}">查看并编辑</a> <a href="adver.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除这个等级吗？') ? true : false;">删除</a></td>
            </tr>
        {/foreach}
        <tr><td colspan="6" style="color: blue;">(* 任何广告服务的操作，都必须生成js文件，前台才能更新)</td></tr>
        <tr>
        <td colspan="6">
            <input type="button" onclick="location.href='?action=text'" value="生成文字广告js">
            <input type="button" onclick="location.href='?action=header'" value="生成头部广告js">
            <input type="button" onclick="location.href='?action=sidebar'" value="生成侧栏广告js">
        </td>
        </tr>
        {else}
            <tr>
                <td colspan="6">对不起，没有任何数据</td>
            </tr>
        {/if}

    </table>
    <div id="page">{$page}</div>
    {/if}

    {if $add}
    <form action="" method="post" name="content">
        <input type="hidden" name="adv">
        <table cellspacing="0" class="left">
            <tr><td>广告类型：
                <input type="radio" name="type" value="1" onclick="adver(1)" checked>文字广告
                <input type="radio" name="type" value="2" onclick="adver(2)">头部广告(690x80)
                <input type="radio" name="type" value="3" onclick="adver(3)">侧栏广告(270x200)
            </td></tr>
            <tr><td>广告标题：<input type="text" name="title" class="text"> (* 广告标题不得小于2位,不得大于20位)</td></tr>
            <tr><td>广告链接：<input type="text" name="link" class="text"> (* 广告链接不得为空)</td></tr>
            <tr style="display: none;" id="thumbnail"><td>广告图片：
                <input type="text" name="thumbnail" class="text" readonly>
                <span id="up"></span>
                <img src="" alt="" style="display: none;" name="pic">(*必须是jpg,gif,png，并且200k内)
            </td></tr>
            <tr><td><textarea name="info"></textarea> (* 描述不得大于200位)</td></tr>
            <tr><td><input type="submit" name="send" value="新增广告" onclick="return checkAdver();" class="submit"> [ <a href="adver.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

    {if $update}
    <form action="" method="post" name="content">
        <input type="hidden" name="id" value="{$id}">
        <input type="hidden" name="adv">
        <table cellspacing="0" class="left">
            <tr><td>广告类型：
                <input type="radio" name="type" value="1" onclick="adver(1)" {$typeText}>文字广告
                <input type="radio" name="type" value="2" onclick="adver(2)" {$typeHeader}>头部广告(690x80)
                <input type="radio" name="type" value="3" onclick="adver(3)" {$typeSidebar}>侧栏广告(270x200)
            </td></tr>
            <tr><td>是否前台广告：
                <input type="radio" name="state" value="1" {$stateShow}>是
                <input type="radio" name="state" value="0" {$stateHide}>否
            </td></tr>
            <tr><td>广告标题：<input type="text" name="title" value="{$titlec}" class="text"> (* 广告标题不得小于2位,不得大于20位)</td></tr>
            <tr><td>广告链接：<input type="text" name="link" value="{$link}" class="text"> (* 广告链接不得为空)</td></tr>
            <tr style="{$picShow}" id="thumbnail"><td>广告图片：
                <input type="text" name="thumbnail" value="{$thumbnail}" class="text" readonly>
                <span id="up">{$picText}</span>
                <img src="{$thumbnail}" alt="" style="{$picShow}" name="pic">(*必须是jpg,gif,png，并且200k内)
            </td></tr>
            <tr><td><textarea name="info">{$info}</textarea> (* 描述不得大于200位)</td></tr>
            <tr><td><input type="submit" name="send" value="修改广告" onclick="return checkAdver();" class="submit"> [ <a href="adver.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

</body>
</html>
