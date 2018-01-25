<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>通知信匣</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>通知信匣</h1>
    <a href="/usercenter/{{$user_id}}">回個人中心</a>
    <hr>
    <h3>所有求職信息</h3>

    @forelse($notice as $notice)
    <form action="{{ url('/companynoticeget/'.$notice->user) }}" method="post" target="_blank" class="noticeform" enctype="multipart/form-data">
      <input type="hidden" id="userid" value="{{$notice->user}}">
      <input type="hidden" id="company_id" name="company_id" value="{{$notice->company_id}}">
      <input type="hidden" id="article_id" name="article_id" value="{{$notice->article_id}}">
      <input type="hidden" id="towho" name="towho" value="employer">
      @if ($notice->towho=='applyer')
      <div align="right" style="width: 1000px;padding: 8px;">
      @else
      <div align="left" style="width: 1000px;padding: 8px;">
      @endif
        <span><b>
          @if ($notice->towho=='applyer')
          From {{ $notice->company }}
          @else
          To {{ $notice->company }}
          @endif
        </b></span>
        <span>Re : <a href="/detail/{{$notice->article_id}}">{{ $notice->atitle }}</a></span>
        <br>
        <span>主旨 : {{ $notice->ntitle }} </span>
        <br>
        @if ($notice->towho=='applyer')
        <span><small><sub>{{ $notice->created_at }}</small></sub></span>
        <span>內容 : {{ $notice->content }}</span>
        @else
        <span>內容 : {{ $notice->content }}</span>
        <span><small><sub>{{ $notice->created_at }}</small></sub></span>
        @endif
        @if ($notice->towho=='applyer')
        <span><input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" name="submit" value="回覆"></span>
        @else
        <span><sub>已傳送</sub></span>
        @endif
      </div></div>
    </form>

    @empty
    @endforelse

    @if(count($notice) < 1)
      <p>尚無通知信</p>
    @endif

    <br>
    <hr>
    <br>

    <h3>檢舉紀錄</h3>
    <table style="width:90%" border="1px solid black">
      <tr>
        <th>檢舉實習</th>
        <th>公司</th>
        <th>原因</th>
        <th>描述</th>
        <th>時間</th>
      </tr>

      @forelse($report as $report)
      <tr>
        <th><a href="/detail/{{$report->article_id}}">{{ $report->article_title }}</a></th>
        <th>{{ $report->article_company }}</th>
        <th>{{ $report->report_reason }}</th>
        <th>{{ $report->report_content }}</th>
        <th>{{ $report->created_at }}</th>
      </tr>
      @empty
      @endforelse
    </table>
    @if(count($report) < 1)
      <p>尚無檢舉紀錄</p>
    @endif


    <script type="text/javascript" src = "../js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
