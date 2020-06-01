window.onload = function() {
    var level = document.getElementById('level');
    var options = document.getElementsByTagName('option');
    if (level) {
        for (var i=0; i<options.length; i++) {
            if (options[i].value == level.value) {
                options[i].setAttribute('selected','selected');
            }
        }
    }

    var title = document.getElementById('title');
    var ol = document.getElementsByTagName('ol');
    var a = ol[0].getElementsByTagName('a');
    for (var i=0; i<a.length; i++) {
        a[i].className = 'null';
        if (title.innerHTML == a[i].innerHTML) {
            a[i].className = 'selected';
        }
    }

};

// 选择头像
function sface() {
    var fm = document.reg;
    var index = fm.face.selectedIndex;
    fm.faceimg.src = "../images/"+fm.face.options[index].value;
}

// 验证添加
function checkForm() {
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
    return true;
}

// 验证修改
function checkUpdate() {
    var fm = document.reg;
    if (fm.pass.value.length != 0) {
        if (fm.pass.value == '' || fm.pass.value.length < 6) {
            alert('警告：密码不得为空并且不得小于6位');
            fm.pass.focus();
            return false;
        }
    }
    if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)) {
        alert('邮件格式不正确');
        fm.email.focus();
        return false;
    }
    return true;
}
