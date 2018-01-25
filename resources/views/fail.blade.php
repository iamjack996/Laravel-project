<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ $msg }}</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>失敗</h1>
    <a href="/allintern">首頁</a><hr>

    @if(Auth::check())
      @if(Auth::user()->isAdmin == 2)
      <div>
        <a href="/allarticle">管理員後台</a><br>
        <a href="/usercenter/{{Auth::user()->id}}">個人中心</a><br>
        <a href="/companycenter/{{Auth::user()->id}}">公司用戶中心</a><br>
      </div>
      @endif
      @if(Auth::user()->isAdmin == 1)
      <div>
        <a href="/companycenter/{{Auth::user()->id}}">公司用戶中心</a><br>
      </div>
      @endif
      @if(Auth::user()->isAdmin == 0)
      <div>
        <a href="/usercenter/{{Auth::user()->id}}">用戶個人中心</a><br>
      </div>
      @endif
    @endif

    <h2>原因 : <b>{{ $msg }}</b></h2>

    <button type="button" id="close">離開</button>

    <script type="text/javascript" src = "js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


  </body>
</html>
