var header = [];
header[0]={
	'title': '卖手机',
	'pic': '/uploads/20200605/20200605021116820.png',
	'link': 'http://jd.com'
};
var i = Math.ceil(Math.random()*10) % 1;
document.write('<a href="'+header[i].link+'" title="'+header[i].title+'" target="_blank"><img src="'+header[i].pic+'" style="border: none;"></a>');
