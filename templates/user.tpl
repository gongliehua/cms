<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
    <script type="text/javascript" src="../js/admin_user.js"></script>
</head>
<body id="main">
    <div class="map">
        管理首页 &gt;&gt; 会员管理 &gt;&gt; <strong id="title">{$title}</strong>
    </div>

    <ol>
        <li><a href="user.php?action=show" class="selected">会员列表</a></li>
        <li><a href="user.php?action=add">新增会员</a></li>

        {if $update}
        <li><a href="user.php?action=update&id={$id}">修改会员</a></li>
        {/if}

    </ol>

    {if $show}
    <table cellspacing="0">
        <tr>
            <th>编号</th>
            <th>用户名</th>
            <th>电子邮箱</th>
            <th>状态</th>
            <th>操作</th>
        </tr>

        {if $AllUser}
        {foreach $AllUser(key,value)}
            <tr>
                <td>{@value->id}</td>
                <td>{@value->user}</td>
                <td>{@value->email}</td>
                <td>{@value->state}</td>
                <td><a href="user.php?action=update&id={@value->id}">编辑</a> <a href="user.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除这个会员吗？') ? true : false;">删除</a></td>
            </tr>
        {/foreach}
        {else}
            <tr>
                <td colspan="5">对不起，没有任何数据</td>
            </tr>
        {/if}

    </table>
    {/if}

    {if $add}
    <form action="" method="post" name="reg">
        <table cellspacing="0" class="user">
            <tr><td>用户名口：<input type="text" class="text" name="user"><span class="reg">[必填]</span>(*用户名在2到20位之间)</td></tr>
            <tr><td>密口口码：<input type="text" class="text" name="pass"><span class="reg">[必填]</span>(*密码不得小于20位)</td></tr>
            <tr><td>密码确认：<input type="text" class="text" name="notpass"><span class="reg">[必填]</span>(*密码和确认密码必须一致 )</td></tr>
            <tr><td>电子邮件：<input type="text" class="text" name="email"><span class="reg">[必填]</span>(*每个电子邮箱只能注册一个ID)</td></tr>
            <tr><td>选择头像：
                    <select name="face" id="" onchange="sface()">
                        {foreach $OptionFaceOne(key,value)}
                        <option value="0{@value}.gif">0{@value}.gif</option>
                        {/foreach}
                        {foreach $OptionFaceTwo(key,value)}
                        <option value="{@value}.gif">{@value}.gif</option>
                        {/foreach}
                    </select>
            </td></tr>
            <tr><td><img name="faceimg" src="../images/01.gif" class="face" alt="01.gif"></td></tr>
            <tr><td>安全问题：
                    <select name="question">
                        <option value="">沒有任何安全问题</option>
                        <option value="您父亲的姓名？">您父亲的姓名？</option>
                        <option value="您母亲的职业？">您母亲的职业？</option>
                        <option value="您配偶的性别？">您配偶的性别？</option>
                    </select>
            </td></tr>
            <tr><td>问题答案：<input type="text" class="text" name="answer"></td></tr>
            <tr><td>
                设置权限：
                <input type="radio" name="state" value="0">被封杀的会员
                <input type="radio" name="state" value="1">待审核的会员
                <input type="radio" name="state" value="2" checked>初级会员
                <input type="radio" name="state" value="3">中级会员
                <input type="radio" name="state" value="4">高级会员
                <input type="radio" name="state" value="5">VIP会员
            </td></tr>
            <tr><td><input type="submit" name="send" value="新增会员" onclick="return checkForm();" class="submit"> [ <a href="user.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

    {if $update}
    <form action="" method="post" name="reg">
        <input type="hidden" name="id" value="{$id}">
        <input type="hidden" name="ppass" value="{$pass}">
        <table cellspacing="0" class="user">
            <tr><td>用户名口：{$user}</td></tr>
            <tr><td>密口口码：<input type="text" class="text" name="pass"><span class="reg">[必填]</span>(*留空则不修改密码)</td></tr>
            <tr><td>电子邮件：<input type="text" class="text" name="email" value="{$email}"><span class="reg">[必填]</span>(*每个电子邮箱只能注册一个ID)</td></tr>
            <tr><td>选择头像：
                    <select name="face" id="" onchange="sface()">
                        {$face}
                    </select>
            </td></tr>
            <tr><td><img name="faceimg" src="../images/{$facesrc}" class="face" alt="01.gif"></td></tr>
            <tr><td>安全问题：
                    <select name="question">
                        {$question}
                    </select>
            </td></tr>
            <tr><td>问题答案：<input type="text" class="text" value="{$answer}" name="answer"></td></tr>
            <tr><td>
                设置权限：
                {$state}
            </td></tr>
            <tr><td><input type="submit" name="send" value="修改会员" onclick="return checkUpdate();" class="submit"> [ <a href="user.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    {/if}

</body>
</html>
