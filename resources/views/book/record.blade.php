<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>中奖记录</title>
</head>
<body>
<img src="https://t.liuqingji.top/book.jpeg" style="width: 100%;height:100px;">
<br />
<br />

@foreach($user_data as $data)
    <span>提交的数字:{{ $data['luck_num'] }};&nbsp;提交时间:{{ $data['created_at'] }}</span><br/>
    @if ($data['status'] == 1)
    <span style="color:red">是否中奖:中奖了-{{ $data['book_name'] }} 英文版;</span><br/>
    @if (!empty($data['order_id']))
        <span>快递单号:{{ $data['order_id'] }}</span><a href="{{ url('api/wechat/order_info') }}?order_id={{ $data['order_id'] }}">&nbsp;&nbsp;点击查看快递信息</a><br/>
    @else
    <span>快递单号:暂无</span><br />
    @endif
    @else
    <span>是否中奖:没有中奖;&nbsp;快递单号:无</span><br />
    @endif
    <br />
@endforeach

@if (!count($user_data))
    <p style="font-size:25px;">还没有提交过信息奥</p>
@endif
</body>
</html>