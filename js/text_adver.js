var text = [];
text[0]={
	'title': '卖洗面奶了！甩卖',
	'link': 'http://taobao.com'
};
var i = Math.ceil(Math.random()*10) % 1;
document.write('<a class="adv" href="'+text[i].link+'" target="_blank">'+text[i].title+'</a>');
