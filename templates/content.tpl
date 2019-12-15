<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../style/admin.css">
    <script type="text/javascript" src="../js/admin_content.js"></script>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <style>
        /* 由于后台的CSS影响了CKEditor的CSS,此处做兼容处理，确认/取消 按钮居中 */
        table.cke_dialog_footer_buttons tr.cke_dialog_ui_hbox {text-align:center;}
        /* 设置显示方式 */
        table.cke_dialog_footer_buttons tr.cke_dialog_ui_hbox td.cke_dialog_ui_hbox_first{display:inline;}
        table.cke_dialog_footer_buttons tr.cke_dialog_ui_hbox td.cke_dialog_ui_hbox_last{display:inline;}
        /* 设置确认按钮文字颜色 */
        table.cke_dialog_footer_buttons tr.cke_dialog_ui_hbox td.cke_dialog_ui_hbox_first a.cke_dialog_ui_button_ok span{color:#fff;}
    </style>
</head>
<body id="main">
    <div class="map">
        内容管理 &gt;&gt; 查看文档列表 &gt;&gt; <strong id="title">{$title}</strong>
    </div>

    <ol>
        <li><a href="content.php?action=show" class="selected">文档列表</a></li>
        <li><a href="content.php?action=add">新增文档</a></li>

        {if $update}
        <li><a href="content.php?action=update&id={$id}">修改文档</a></li>
        {/if}

    </ol>

    {if $add}
    <form action="">
        <table cellspacing="0" class="content">
            <tr><th><strong>发布一条新文档</strong></th></tr>
            <tr><td>文档标题: <input type="text" name="title" class="text"></td></tr>
            <tr><td>栏口口目:
                <select name="nav">
                    <option value="">请选择一个类别</option>
                </select>
            </td></tr>
            <tr><td>定义属性: 
                <input type="checkbox" name="top" value="头条">头条
                <input type="checkbox" name="rec" value="推荐">推荐
                <input type="checkbox" name="bold" value="加粗">加粗
                <input type="checkbox" name="skip" value="跳转">跳转
            </td></tr>
            <tr><td>标口口签: <input type="text" name="tag" class="text"></td></tr>
            <tr><td>关键字口: <input type="text" name="keyword" class="text"></td></tr>
            <tr><td>略缩图口: <input type="text" name="thumbnail" class="text"> <input type="button" value="上次缩略图" onclick="centerWindow('../templates/upfile.html','upfile','400','100')"></td></tr>
            <tr><td>文章来源: <input type="text" name="source" class="text"></td></tr>
            <tr><td>作口口者: <input type="text" name="author" class="text"></td></tr>
            <tr><td><span class="middle">内容摘要: </span><textarea name="info" cols="30" rows="10"></textarea></td></tr>
            <tr class="ckeditor"><td><textarea id="Textarea1" class="ckeditor" name="content"></textarea></td></tr>
            <tr><td>评论选项:
                <input type="radio" name="comment" value="1" checked="checked">允许评论
                <input type="radio" name="comment" value="0">禁止评论
                浏览次数: <input type="text" name="count" value="100" class="text small">
            </td></tr>
            <tr><td>文档排序:
                <select name="sort">
                    <option value="">默认排序</option>
                    <option value="">置顶一天</option>
                    <option value="">置顶一周</option>
                    <option value="">置顶一月</option>
                    <option value="">置顶一年</option>
                </select>
                消费金币: <input type="text" name="count" value="0" class="text small">
            </td></tr>
            <tr><td>阅读权限:
                <select name="limit">
                    <option value="">开放浏览</option>
                    <option value="">初级会员</option>
                    <option value="">中级会员</option>
                    <option value="">高级会员</option>
                    <option value="">VIP会员</option>
                </select>
                默认颜色:
                <select name="color">
                    <option value="">默认颜色</option>
                    <option value="" style="color: red;">红色</option>
                    <option value="" style="color: blue;">蓝色</option>
                    <option value="" style="color: orange;">橙色</option>
                </select>
            </td></tr>
            <tr><td><input type="submit" value="发布文档"> <input type="reset" value="重置"></td></tr>
            <tr><td></td></tr>
        </table>
    </form>
    {/if}
</body>
</html>
