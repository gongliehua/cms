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

// 验证等级
function checkForm() {
    var fm = document.add;
    if (fm.level_name.value == '' || fm.level_name.value.length < 2 || fm.level_name.value.length > 20) {
        alert('警告：等级名称不得为空并且不得小于2位或不得大于20位');
        fm.level_name.focus();
        return false;
    }
    if (fm.level_info.value.length > 255) {
        alert('警告：描述不得大于255位');
        fm.level_info.focus();
        return false;
    }
    return true;
}
