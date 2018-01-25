<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>編輯通知腳本</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>
      @if ($towho=='applyer')
      通知應徵者
      @else
      回覆公司
      @endif
    </h1>

    <form action="{{ url('/companynoticepost/'.$article_id) }}" method="post">
      <input type="hidden" name="company_id" value="{{$company_id}}">
      <input type="hidden" name="user_id" value="{{$user_id}}">
      <input type="hidden" name="article_id" value="{{$article_id}}">
      <input type="hidden" id="towho" name="towho" value="{{$towho}}">
      <div>
        <label>回覆標題</label>
        <input type="text" name="title">
      </div>
      <div>
        <label>通知內容</label>
        <textarea name="content" rows="8" cols="54"></textarea>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" name="submit" value="通知！" >
    </form>

    <script type="text/javascript" src = "../js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


  </body>
</html>
