<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>提交结果</title>
</head>
<body>
<img src="https://t.liuqingji.top/book.jpeg" style="width: 100%;height:100px;">
<br />
<br />

@if ($status == 0)
    <p>
        {{ $message }}
    </p>
@endif

@if ($status == 1)
    <p style="font-size: 20px;color:red">您获得了小说读物：  {{ $book_name }},请填写您的收货地址奥</p>
<form action="{{url('api/wechat/book_result')}}" method="post">
    <input type="text" class="form-control" placeholder="您的地址" name="address"/>
    <br />
    <input type="text" class="form-control" placeholder="您的手机号" name="phone"/>
    <br />
    <button type="sumbit" class="btn btn-primary btn-lg btn-block">提交</button>
</form>
@endif
</body>
</html>