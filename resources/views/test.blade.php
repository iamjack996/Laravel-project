<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Test ajax get/post!</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>

    <button type="button" name="button" id="get">Get Data</button>
    <hr>
    <button type="button" name="button2" id="try">touch</button>
    <hr>

    <form id="form" >- Post Data -

      <div>Name >
        <input type="text" name="problem_name">
      </div>
      <div>Email >
        <input type="text" name="problem_mail">
      </div>
      <div>Title >
        <input type="text" name="problem_title">
      </div>
      <div>Content >
        <input type="text" name="problem_content">
      </div>
      <div>Kind >
        <input type="text" name="problem_kind">
      </div>
      <div>Time >
        <input type="text" name="problem_time">
      </div>

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" name="submit" value="submit">
    </form>

    <div id="msg">hello! message : </div>

    <div id="show">your data in here.</div>



    <script type="text/javascript" src = "js/app.js"></script>




  </body>
</html>
