window.onload = function() {
    var level = document.getElementById('level');
    var options = document.getElementsByTagName('option');
    for (var i=0; i<options.length; i++) {
        if (options[i].value == level.value) {
            options[i].setAttribute('selected','selected');
        }
    }
};
