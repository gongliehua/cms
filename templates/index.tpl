<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS内容管理系统</title>
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    {include file="header.tpl"}
    <div id="user">
        <h2>会员信息</h2>
        <form action="">
            <label for="">用户名：<input type="text" name="username" class="text"></label>
            <label for="">密口码：<input type="password" name="password" class="text"></label>
            <label for="">验证码：<input type="text" name="code" class="text code"></label>
            <img src="images/vdimgck.png" alt="验证码">
            <p><input type="submit" name="send" class="submit" value="登录"> <a href="#">注册会员</a> <a href="#">忘记密码？</a></p>
        </form>
        <h3>最近登录会员 <span>—————————————</span></h3>
        <dl>
            <dt><img src="images/01.gif" alt="头像"></dt>
            <dd>樱桃小丸子</dd>
        </dl>
        <dl>
            <dt><img src="images/04.gif" alt="头像"></dt>
            <dd>樱桃小丸子</dd>
        </dl>
        <dl>
            <dt><img src="images/12.gif" alt="头像"></dt>
            <dd>樱桃小丸子</dd>
        </dl>
        <dl>
            <dt><img src="images/14.gif" alt="头像"></dt>
            <dd>樱桃小丸子</dd>
        </dl>
        <dl>
            <dt><img src="images/17.gif" alt="头像"></dt>
            <dd>樱桃小丸子</dd>
        </dl>
        <dl>
            <dt><img src="images/22.gif" alt="头像"></dt>
            <dd>樱桃小丸子</dd>
        </dl>
    </div>
    <div id="news">
        <h3><a href="#">我是h3标签</a></h3>
        <p>橄榄枝是油橄榄的树枝，橄榄枝象征和平。圣经故事中曾用它作为大地复苏的标志，后来西方国家把它用作和平象征。《圣经·创世纪》记述：“此事发生在2月17日。这一天，巨大的深渊之源全部冲决，天窗大开，大雨40天40夜浇注到大地上。”诺亚和他的妻子乘坐方舟，在大洪水中漂流了40天以后，搁浅在高山上。为了探知大洪水是否退去，诺亚先是放出乌鸦，随后又两次放出鸽子，直到他第二次放出的鸽子衔回橄榄枝后，说明洪水已经退去。<a href="#">[查看全文]</a></p>
        <p class="link">
            <a href="#">橄榄枝象征和平橄榄枝象征和平</a>|
            <a href="#">橄榄枝象征和平橄榄枝象征和平</a>
            <a href="#">橄榄枝象征和平橄榄枝象征和平</a>|
            <a href="#">橄榄枝象征和平橄榄枝象征和平</a>
        </p>
        <ul>
            <li><em>11-06-02</em><a href="#">圣经故事中曾平橄榄平橄榄作为大地复苏的平橄榄标志</a></li>
            <li><em>11-06-02</em><a href="#">圣经故事中曾平橄榄平橄榄作为大地复苏的平橄榄标志</a></li>
            <li><em>11-06-02</em><a href="#">圣经故事中曾平橄榄平橄榄作为大地复苏的平橄榄标志</a></li>
            <li><em>11-06-02</em><a href="#">圣经故事中曾平橄榄平橄榄作为大地复苏的平橄榄标志</a></li>
            <li><em>11-06-02</em><a href="#">圣经故事中曾平橄榄平橄榄作为大地复苏的平橄榄标志</a></li>
            <li><em>11-06-02</em><a href="#">圣经故事中曾平橄榄平橄榄作为大地复苏的平橄榄标志</a></li>
            <li><em>11-06-02</em><a href="#">圣经故事中曾平橄榄平橄榄作为大地复苏的平橄榄标志</a></li>
        </ul>
    </div>
    <div id="pic">
        <img src="images/adverleft.png" alt="新闻图片">
    </div>
    <div id="rec">
        <h2>特别推荐</h2>
        <ul>
            <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
        </ul>
    </div>
    <div id="sidebar-right">
        <div class="adver"><img src="images/adver2.png" alt="广告图"></div>
        <div class="hot">
            <h2>本月热点</h2>
            <ul>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            </ul>
        </div>
        <div class="comm">
            <h2>本月评论</h2>
            <ul>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            </ul>
        </div>
        <div class="vote">
            <h2>本月投票</h2>
            <h3>请问您是怎么知道本站的？</h3>
            <form action="">
                <label><input type="radio" name="vote" checked> 门户网站</label>
                <label><input type="radio" name="vote"> Google或百度搜索</label>
                <label><input type="radio" name="vote"> 别的网站上的链接</label>
                <label><input type="radio" name="vote"> 朋友介绍或电视广告</label>
                <p><input type="submit" name="send" value="投票"> <input type="button" value="查看"></p>
            </form>
        </div>
    </div>
    <div id="picnews">
        <h2>图文资讯</h2>
        <dl>
            <dt><a href="#"><img src="images/pic1.png" alt="标题"></a></dt>
            <dd><a href="#">以色列总理以色列总理出访发过出访发过</a></dd>
        </dl>
        <dl>
            <dt><a href="#"><img src="images/pic2.png" alt="标题"></a></dt>
            <dd><a href="#">以色列总理出访发过以色列总理出访发过</a></dd>
        </dl>
        <dl>
            <dt><a href="#"><img src="images/pic3.png" alt="标题"></a></dt>
            <dd><a href="#">以色列总理出访发过以色列总理出访发过</a></dd>
        </dl>
        <dl>
            <dt><a href="#"><img src="images/pic4.png" alt="标题"></a></dt>
            <dd><a href="#">以色列总理出访发过以色列总理出访发过</a></dd>
        </dl>
    </div>
    <div id="newslist">
        <div class="list bottom">
            <h2><a href="#">更多</a>军事动态</h2>
            <ul>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            </ul>
        </div>
        <div class="list right bottom">
            <h2><a href="#">更多</a>八卦娱乐</h2>
            <ul>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            </ul>
        </div>
        <div class="list">
            <h2><a href="#">更多</a>时尚女人</h2>
            <ul>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            </ul>
        </div>
        <div class="list right">
            <h2><a href="#">更多</a>科技频道</h2>
            <ul>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
                <li><em>06-21</em><a href="#">特别推荐女人尚别推荐女人尚别推...</a></li>
            </ul>
        </div>
    </div>
    {include file='footer.tpl'}
</body>
</html>
