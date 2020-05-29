// 选择头像
function sface() {
    var fm = document.reg;
    var index = fm.face.selectedIndex;
    fm.faceimg.src = "images/"+fm.face.options[index].value;
}

// 验证注册
function checkReg() {
    var fm = document.reg;
    if (fm.user.value == '' || fm.user.value.length < 2 || fm.user.value.length > 20) {
        alert('警告：用户名不得为空并且不得小于2位或大于20位');
        fm.user.focus();
        return false;
    }
    if (fm.pass.value == '' || fm.pass.value.length < 6) {
        alert('警告：密码不得为空并且不得小于6位');
        fm.pass.focus();
        return false;
    }
    if (fm.pass.value != fm.notpass.value) {
        alert('警告：密码和确认密码不一致');
        fm.notpass.focus();
        return false;
    }
    if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)) {
        alert('邮件格式不正确');
        fm.email.focus();
        return false;
    }
    if (fm.code.value.length != 4) {
        alert('警告：验证码必须是4位');
        fm.code.focus();
        return false;
    }
    return true;
}
// 登录
function checkLogin() {
    var fm = document.login;
    if (fm.user.value == '' || fm.user.value.length < 2 || fm.user.value.length > 20) {
        alert('警告：用户名不得为空并且不得小于2位或大于20位');
        fm.user.focus();
        return false;
    }
    if (fm.pass.value == '' || fm.pass.value.length < 6) {
        alert('警告：密码不得为空并且不得小于6位');
        fm.pass.focus();
        return false;
    }
    if (fm.code.value.length != 4) {
        alert('警告：验证码必须是4位');
        fm.code.focus();
        return false;
    }
    return true;
}
