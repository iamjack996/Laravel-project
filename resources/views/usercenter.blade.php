<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>用戶中心</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>{{$user->name}}用戶的個人中心</h1>
    <a href="/allintern">首頁</a><hr>
    <a href="/#">我的履歷</a><br>
    <a href="/collecterecord/{{$user->id}}">收藏實習</a><br>
    <a href="/applyrecord/{{$user->id}}">應徵紀錄</a><br>
    <a href="/usernotice/{{$user->id}}">通知信匣</a><br>
    <br>
    <a href="#" id="lovecompany"><span id="cf">顯示追蹤中公司動態({{$follow}}) ◢</span></a>
    <!-- <button type="button" name="button" id="lovecompany">追蹤公司</button>  -->
    <input type="hidden" id="cfed" value="0">
    <div id="user" hidden>{{$user->id}}</div>
    <div id="showcompany"></div>

    <script type="text/javascript" src = "../js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
