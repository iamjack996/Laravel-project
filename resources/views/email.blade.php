<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>訂閱我們！</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>訂閱我們</h1>
    <a href="/allintern">首頁</a>
    <hr>
    <form action="{{ url('/notify') }}" method="post">
      <input type="text" name="email" placeholder="輸入你的email"><br>
      <input type="submit" name="submit" id="search" value="訂閱！">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

  </body>
</html>
