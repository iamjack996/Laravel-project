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
      @if ($towho=='BtoC')
      管理者通知
      @elseif ($towho =='applyer')
      回覆應徵者
      @else
      回覆公司
      @endif
    </h1>
    <br>
    <div><b>選取的公司 - 文章 :</b></div>
    <form action="{{ url('/noticespost') }}" method="post">
      @forelse($article as $article)
        <span>{{ $article->company }} - {{ $article->title }}、 </span>
        <input type="hidden" name="article_id[]" value="{{$article->id}}">
      @empty
      @endforelse
      <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
      <input type="hidden" id="towho" name="towho" value="{{$towho}}">

      <br><br>

      <div>
        <label>內容</label>
        <textarea name="content" rows="4" cols="36"></textarea>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" name="submit" value="傳送" >
      <button type="button" id="close">取消</button>
    </form>

    <script type="text/javascript" src = "js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


  </body>
</html>
