<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>我的视频列表</title>
</head>
<body>
<p>~~~~~~~~~~~~~~~~~~~~~~</p>
<img src="https://t.liuqingji.top/image/shanshui.jpeg" style="width: 100%;height:100px;">
<br />
<br />
@foreach($data as $da)
    <span>图片:{{ $data['img_url'] }};&nbsp;视频状态:
    @if ($data['status'] == 0)
       等待合成中
    @elseif( $data['status'] == 1)
       合成完成
    @else
        合成失败
    @endif
    <br />
@endforeach

@if (!count($data))
    <p style="font-size:25px;">还没有提交过信息奥</p>
@endif
<p style="margin-top: 50%;float:right"><a href="{{ url('api/wechat/book_record') }}">    查看我的中奖记录&nbsp;&nbsp;</a></p>
</body>
</html>