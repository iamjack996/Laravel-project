<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>編輯通知腳本</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>通知應徵者結果</h1>
    <a href="/internapplicants/{{$article_id}}">回上一頁</a><hr>

    <form action="{{ url('/notice/'.$article_id) }}" method="post">
      <input type="hidden" name="company_id" value="{{$company_id}}">
      @forelse($user_id as $user_id)
      <input type="hidden" name="user_id[]" value="{{$user_id}}">
      @empty
      @endforelse
      <div>
        <label>回覆通知類型</label>
        <select name="title">
          <option value="錄取通知">錄取通知</option>
          <option value="不錄取通知">不錄取通知</option>
        </select>
      </div>
      <div>
        <label>通知內容</label>
        <textarea name="content" rows="8" cols="54"></textarea>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" name="submit" value="通知！">
    </form>
    {{$msg or ''}}

  </body>
</html>
