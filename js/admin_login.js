// 验证登录
function checkLogin() {
    var fm = document.login;
    if (fm.admin_user.value == '' || fm.admin_user.value.length < 2 || fm.admin_user.value.length > 20) {
        alert('警告：用户名不得为空并且不得小于2位或大于20位');
        fm.admin_user.focus();
        return false;
    }
    if (fm.admin_pass.value == '' || fm.admin_pass.value.length < 6) {
        alert('警告：密码不得为空并且不得小于6位');
        fm.admin_pass.focus();
        return false;
    }
    if (fm.code.value.length != 4) {
        alert('警告：验证码必须是4位');
        fm.code.focus();
        return false;
    }
    return true;
}
