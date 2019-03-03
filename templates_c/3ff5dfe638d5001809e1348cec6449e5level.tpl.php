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
        管理首页 &gt;&gt; 等级管理 &gt;&gt; <strong id="title"><?php echo $this->_vars['title']; ?></strong>
    </div>

    <ol>
        <li><a href="level.php?action=show" class="selected">等级列表</a></li>
        <li><a href="level.php?action=add">新增等级</a></li>

        <?php if ($this->_vars['update']) { ?>
        <li><a href="level.php?action=update&id=<?php echo $this->_vars['id']; ?>">修改等级</a></li>
        <?php } ?>

    </ol>

    <?php if ($this->_vars['show']) { ?>
    <table cellspacing="0">
        <tr>
            <th>编号</th>
            <th>等级名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>

        <?php foreach ($this->_vars['AllLevel'] as $key=>$value) { ?>
            <tr>
                <td><?php echo $value->id; ?></td>
                <td><?php echo $value->level_name; ?></td>
                <td><?php echo $value->level_info; ?></td>
                <td><a href="level.php?action=update&id=<?php echo $value->id; ?>">编辑</a> <a href="level.php?action=delete&id=<?php echo $value->id; ?>" onclick="return confirm('您真的要删除这个等级吗？') ? true : false;">删除</a></td>
            </tr>
        <?php } ?>

    </table>
    <?php } ?>

    <?php if ($this->_vars['add']) { ?>
    <form action="" method="post">
        <table cellspacing="0" class="left">
            <tr><td>等级名称：<input type="text" name="level_name" class="text"> (* 等级名称不得小于2位,不得大于20位)</td></tr>
            <tr><td><textarea name="level_info"></textarea> (* 描述不得大于255位)</td></tr>
            <tr><td><input type="submit" name="send" value="新增等级" class="submit"> [ <a href="level.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    <?php } ?>

    <?php if ($this->_vars['update']) { ?>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $this->_vars['id']; ?>">
        <table cellspacing="0" class="left">
            <tr><td>等级名称：<input type="text" name="level_name" value="<?php echo $this->_vars['level_name']; ?>" class="text"> (* 等级名称不得小于2位,不得大于20位)</td></tr>
            <tr><td><textarea name="level_info"><?php echo $this->_vars['level_info']; ?></textarea> (* 描述不得大于255位)</td></tr>
            <tr><td><input type="submit" name="send" value="修改等级" class="submit"> [ <a href="level.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
    <?php } ?>

</body>
</html>
