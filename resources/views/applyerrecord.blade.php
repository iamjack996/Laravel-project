<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>管理文章頁面</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>發布過的實習貼文</h1>
    <a href="/companycenter/{{$apply_user_id}}">公司中心</a><hr>

    <input type="hidden" name="user_id" value="{{$apply_user_id}}">

    <table style="width:90%" border="1px solid black">
      <tr>
        <th>實習標題</th>
        <th>實習類別</th>
        <th>地點</th>    
        <th>薪資</th>
        <th>需求人數</th>
        <th>應徵人數</th>
        <th>收藏人數</th>
        <th>到期日</th>
        <th>新增時間</th>
        <th>編輯文章</th>
        <th>瀏覽實習</th>
      </tr>
      @for($i=0; $i<=count($article)-1; $i++)
        <tr>
          <th><a href="/internapplicants/{{$article[$i]->id}}">查看應徵者 > </a> {{ $article[$i]->title }}</th>
          <th>{{ $article[$i]->type }}</th>
          <th>{{ $article[$i]->location }}</th>
          <th>{{ $article[$i]->salt }}元/月</th>
          <th>{{ $article[$i]->numofpeople }}</th>
          <th>{{ $article[$i]->numofapply }}人</th>
          <th>{{ $article[$i]->numoflike }}人</th>
          <th>
            @if($article[$i]->deadline >= $now)
            {{ $article[$i]->deadline }}
            @else
            <i>{{ $article[$i]->deadline }}*</i>
            @endif
          </th>
          <th>{{ $article[$i]->created_at }}</th>
          <th><a href="/updatearticle/{{$article[$i]->id}}">Update</th>
          <th><a href="/detail/{{$article[$i]->id}}">檢視</th>
        </tr>
      @endfor
    </table>

    @if(count($article) < 1)
      <p>尚無實習貼文</p>
    @endif


    <script type="text/javascript" src = "../js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
