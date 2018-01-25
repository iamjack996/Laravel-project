<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>新增電子報活動</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>新增電子報活動</h1>
    <a href="/allarticle">回到後台</a>
    <hr>
    <form action="{{ url('/campaign') }}" method="post">
      <input type="text" name="subject" placeholder="活動名稱"><br>
      <input type="text" name="name" placeholder="主辦方名稱(FUTURA)" value="FUTURA"><br>
      <input type="text" name="email" placeholder="主辦方email"><br>
      <textarea name="content" rows="4" cols="36" placeholder="活動內容"></textarea><br>
      <input type="submit" name="submit" id="search" value="發送給訂閱者">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

  </body>
</html>
