<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>應徵紀錄</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>應徵紀錄</h1>
    <a href="/usercenter/{{$apply_user_id}}">用戶個人中心</a><hr>

    <form action="{{ url('/deleteapply') }}" method="post" >
      <input type="hidden" name="user_id" value="{{$apply_user_id}}">
      <table style="width:90%" border="1px solid black">
        <tr>
          <th>選擇刪除</th>
          <th>應徵實習</th>
          <th>實習類別</th>
          <th>應徵公司</th>
          <th>地點</th>
          <th>待遇</th>
          <th>到期日</th>
          <th>應徵時間</th>
          <th>對話</th>
        </tr>
        @for($i=0; $i<=count($article)-1; $i++)
          <tr>
            <th><input type="checkbox" name="applyid[]" value="{{ $apply[$i]->id }}"></th>
            <th>
              @if($article[$i] >= $now)
              <a href="/detail/{{$apply[$i]->article_id}}">{{ $apply[$i]->article_title }}
              @else
              <i>{{ $apply[$i]->article_title }}</i>
              @endif
            </th>
            <th>{{ $apply[$i]->article_type }}</th>
            <th><a href="/company/{{$apply[$i]->company_id}}">{{ $apply[$i]->article_company }}</th>
            <th>{{ $apply[$i]->article_location }}</th>
            <th>{{ $article2[$i] }}元/月</th>
            <th>
              @if($article[$i] >= $now)
              {{ $article[$i] }}
              @else
              <i>{{ $article[$i] }}*</i>
              @endif
            </th>
            <th>{{ $apply[$i]->created_at }}</th>
            <th><a href="/applyrecord/{{$apply[$i]->article_id}}/talks/{{$apply_user_id}}">˙˙˙</th>
          </tr>
        @endfor
      </table>
      @if(count($apply) < 1)
        <p>尚無應徵實習</p>
      @endif

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" value="刪除">
    </form>

  </body>
</html>
