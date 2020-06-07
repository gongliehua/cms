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

function _link(type)
{
    var logo = document.getElementById('logo');
    switch(type) {
        case 1:
            logo.style.display = 'none';
            break;
        case 2:
            logo.style.display = 'block';
    }
}

// 验证
function checkForm() {
    var fm = document.link;
    if (fm.webname.value == '' || fm.webname.value.length < 2 || fm.webname.value.length > 20) {
        alert('警告：网站名称不得为空并且不得小于2位或大于20位');
        fm.webname.focus();
        return false;
    }
    if (fm.weburl.value == '' || fm.weburl.value.length > 100) {
        alert('警告：网站地址不得为空并且不得大于100位');
        fm.weburl.focus();
        return false;
    }
    if (fm.user.value.length > 20) {
        alert('警告：站长名字不得大于20位');
        fm.user.focus();
        return false;
    }
    if (fm.type.value.length == '2') {
        if (fm.logourl.value.length == '') {
            alert('警告：LOGO地址不得为空');
            fm.logourl.focus();
            return false;
        }
    }
    if (fm.code.value.length != 4) {
        alert('警告：验证码必须是4位');
        fm.code.focus();
        return false;
    }
    return true;
}
