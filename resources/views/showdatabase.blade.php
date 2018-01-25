<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  </head>
  <body>
    <h3>SQL backup</h3>

    <a href="/downloadsql">下載最新資料庫</a>
    Time : {{ $sql }}

    <form action="{{ url('/appendtofile') }}">
      <input type="text" name="content" id="content" placeholder="Append..">
      <input type="submit" name="submit" id="append" value="添加">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    <div id="file">
      {{ $test }}
    </div>

    <script type="text/javascript" src = "js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
