<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ｆｕｔｕｒａ - 找</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>搜尋你想找的實習工作</h1>
    <span>本頁面搜尋將會往本站與外部主供應實習平台找尋結果</span>
    <hr>
    <form action="{{ url('/#') }}">
      <input type="text" name="search" id="key" placeholder="Search..">　　
      <input type="submit" name="submit" id="searchall" value="搜尋">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    <center>
      <hr>
      <label>= Futura =</label>
      <div id="futura">我有共{{ $count }}筆實習！</div>
      <hr>
      <label>= 104實習 =</label>
      <div id="e04">我有{{ $count104 }}實習！</div>
      <hr>
      <label>= 1111實習 =</label>
      <div id="e111">我有共{{ $count1111 }}筆實習！</div>
    </center>

  <script type="text/javascript" src = "js/app.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
