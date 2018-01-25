<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>收藏實習</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>收藏實習</h1>
    <a href="/usercenter/{{$user_id}}">用戶個人中心</a><hr>

    <form action="{{ url('/deletecollection') }}" method="post" >
      <input type="hidden" name="user_id" value="{{$user_id}}">
      <table style="width:90%" border="1px solid black">
        <tr>
          <th>選擇刪除</th>
          <th>收藏實習</th>
          <th>實習類別</th>
          <th>應徵公司</th>
          <th>地點</th>
          <th>待遇</th>
          <th>到期日</th>
          <th>加入收藏時間</th>
        </tr>
          @for($i=0; $i<=count($article)-1; $i++)
            <tr>
              <th><input type="checkbox" name="collectionid[]" value="{{ $collection[$i]->id }}"></th>
              <th>
                @if($article[$i] >= $now)
                <a href="/detail/{{$collection[$i]->article_id}}">{{ $collection[$i]->article_title }}
                @else
                <i>{{ $collection[$i]->article_title }}</i>
                @endif
              </th>
              <th>{{ $collection[$i]->article_type }}</th>
              <th><a href="/company/{{$collection[$i]->company_id}}">{{ $collection[$i]->article_company }}</th>
              <th>{{ $collection[$i]->article_location }}</th>
              <th>{{ $articlesalt[$i] }}元/月</th>
              <th>
                @if($article[$i] >= $now)
                {{ $article[$i] }}
                @else
                <i>{{ $article[$i] }}*</i>
                @endif
              </th>
              <th>{{ $collection[$i]->created_at }}</th>
            </tr>
          @endfor
      </table>
      @if(count($collection) < 1)
        <p>尚無收藏文章</p>
      @endif

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" value="刪除">
    </form>

  </body>
</html>
