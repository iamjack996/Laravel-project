<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>檢視所有檢舉</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>檢舉紀錄</h1>
    <a href="/allarticle">後台</a>
    <hr>
    <table style="width:90%" border="1px solid black">
      <tr>
        <th>回報用戶</th>
        <th>檢舉公司</th>
        <th>檢舉文章</th>
        <th>文章類型</th>
        <th>檢舉原因</th>
        <th>描述</th>
        <th>檢舉時間</th>
      </tr>
      @forelse($report as $report)
        <tr>
          <th>{{ $report->name }}</th>
          <th><a href="/company/{{$report->company_id}}">{{ $report->article_company }}</th>
          <th><a href="/detail/{{$report->article_id}}">{{ $report->article_title }}</th>
          <th>{{ $report->article_type }}</th>
          <th>{{ $report->report_reason }}</th>
          <th>{{ $report->report_content }}</th>
          <th>{{ $report->created_at }}</th>
        </tr>
      @empty
      <div>無檢舉紀錄</div>
      @endforelse
    </table>


  </body>
</html>
