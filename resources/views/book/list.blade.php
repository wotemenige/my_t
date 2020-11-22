<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>幸运获书</title>
</head>
<body>
<img src="https://t.liuqingji.top/book.jpeg" style="width: 100%;height:100px;">
<br />
<br />
<p style="font-size: 15px">&nbsp;&nbsp;每本书都有自己的的幸运数字，西红柿已经在后台设置好了书的幸运数字</p>
<p style="font-size: 15px">&nbsp;&nbsp;只要你填写的数字和书的幸运数字一样，那么，你就可以获取到这本书了</p>
<p style="font-size: 15px">&nbsp;&nbsp;你问幸运数字是什么？只能说是1-30里面的数字</p>
<p style="font-size: 15px">&nbsp;&nbsp;你问有什么书？都是外国原著小说读本</p>
<p style="font-size: 15px">&nbsp;&nbsp;每天都有填写机会，先到先得奥</p>
<br/>
<form action="{{url('api/wechat/submit_luck_num')}}" method="post">
    <input type="text" class="form-control" placeholder="填写一个幸运数字" name="num"/>
    <br />
    <button type="sumbit" class="btn btn-primary btn-lg btn-block">提交</button>
</form>

<p style="margin-top: 50%;float:right"><a href="{{ url('api/wechat/book_record') }}">    查看我的中奖记录&nbsp;&nbsp;</a></p>
</body>
</html>