<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>實習文應徵者</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>回應應徵者</h1>
    <a href="/companycenter/{{$article->user_id}}">公司中心</a>
    <a href="/applyerrecord/{{$article->user_id}}">回到所有文章</a>
    <hr>

    <div><big>標題 : <a href="/detail/{{$article->id}}">{{ $article->title }}</a></big> 需求數 : {{ $article->numofpeople }} 發布於 : {{ $article->created_at }} 截止日 : {{ $article->deadline }} 待遇 : ${{ $article->salt }}</div>
    <br>

    <form action="{{ url('/noticeapplicants/'.$article->user_id) }}" method="post" >
      <input type="hidden" name="article_id" value="{{$article_id}}">
      <input type="hidden" name="company_id" value="{{$article->user_id}}">
      <table style="width:90%" border="1px solid black">
        <tr>
          <th>選擇通知者</th>
          <th>應徵者</th>
          <th>應徵者email</th>
          <th>應徵時間</th>
          <th>通知紀錄</th>
          <th>對話</th>
        </tr>

      @forelse($users as $users)

        <tr>
          <td><input type="checkbox" name="applicantsid[]" value="{{ $users->id }}"></td>
          <td>{{ $users->name }}</td>
          <td>{{ $users->email }}</td>
          <td>{{ $users->created_at }}</td>
          @if ($users->notice>0)
          <td>Yes</td>
          @else
          <td>No</td>
          @endif
          <td><a href="/internapplicants/{{$article_id}}/talks/{{ $users->id }}">˙˙˙</td>
        </tr>

      @empty
      @endforelse

      </table>
      @if(count($users) < 1)
        <p>尚無應徵者</p>
      @endif
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" value="通知">

    </form>

    </body>
</html>
