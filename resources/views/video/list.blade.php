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
<>
<img src="https://t.liuqingji.top/image/shanshui.jpeg" style="width: 100%;height:100px;">
<br />
<br />
<p style="margin-right:30px;float:right"><a href="{{ url('api/wechat/video_add') }}">点我去视频合成&nbsp;</a></p>
<br />
<br />
<span>视频示例</span>
<video width="100" height="100" controls>
    <source src="https://tliu.oss-cn-beijing.aliyuncs.com//www/wwwroot/blog/public/video/1606562128.mp4" type="video/mp4">
</video>
<br />
<br />
@foreach($datas as $data)
    <span>图片:上传成功;&nbsp;视频状态:
    @if ($data['status'] == 0)
            <span style="color:grey">等待合成中</span><br />
    @elseif( $data['status'] == 1)
            <span style="color:grey">正在合成</span><br />
    @elseif( $data['status'] == 2)
            {{--<a href="javascript:void(0);" onclick="downVideo('{{ $data['video_url'] }}','my.mp4')">合成成功-点击下载</a>--}}
        {{--、、//<p class="code-btn copy" id="codeBtn" data-clipboard-target="#input">复制邀请码</p>--}}
            <p style="word-break: break-word;color:silver">合成成功；视频链接:      {{ $data['video_url'] }}</p>
            <video width="200" height="100" controls>
            <source src="{{ $data['video_url'] }}" type="video/mp4">
            </video>
        <br />
    @else
            <span style="color:grey">失败</span><br />
    @endif
    <br />
@endforeach
</body>
</html>