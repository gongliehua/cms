var sidebar = [];
sidebar[0]={
	'title': '书面广告',
	'pic': '/uploads/20200605/20200605021151108.png',
	'link': 'http://read.douban.com'
};
var i = Math.ceil(Math.random()*10) % 1;
document.write('<a href="'+sidebar[i].link+'" title="'+sidebar[i].title+'" target="_blank"><img src="'+sidebar[i].pic+'" style="border: none;"></a>');
