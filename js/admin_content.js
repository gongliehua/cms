window.onload = function() {
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

function centerWindow(url,name,width,height) {
    var left = (screen.width - width)/2;
    var top = (screen.height - height)/2 - 50;
    window.open(url,name,'width='+width+',height='+height+',top='+top+',left='+left);
}
