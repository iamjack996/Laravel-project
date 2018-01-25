<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>公司中心</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>{{$user->name}}管理中心</h1>
    <a href="/allintern">首頁</a>
    <a href="/addarticle/{{$user->id}}">新增實習</a> <br>
    <hr>

    <a href="/company/{{$user->id}}">公司資訊</a><br>
    <a href="/applyerrecord/{{$user->id}}">管理實習文章</a><br>
    <a href="/companynotice/{{$user->id}}">已通知信匣</a><br>

    <span>通知({{ count(auth()->user()->unreadnotifications) }}) : <br>
      @foreach(auth()->user()->unreadnotifications as $notification)
        <!-- {{$notification->type}} -->
        <br>
      @endforeach
    </span>

  </body>
</html>
