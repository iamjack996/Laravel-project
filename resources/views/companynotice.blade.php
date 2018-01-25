<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>通知信匣</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>已通知信匣</h1>
    <a href="/companycenter/{{$company_id}}">公司中心</a>
    <hr>

    <button type="button" name="button" id="foruser">依應徵者排序</button>
    <input type="hidden" id="companyid" value="{{$company_id}}">
    <br>

    <select id="titleselect">
      <option value="all">選擇實習</option>
      @forelse($title as $title)
      <option value="{{$title->id}}">{{$title->title}}</option>
      @empty
      @endforelse
    </select>
    <br>
    <label>應徵者訊息</label>


    <table style="width:90%" border="1px solid black">
      <tr>
        <th>應徵者</th>
        <th>應徵實習</th>
        <th>附註</th>
        <th>內容</th>
        <th>通知時間</th>
        <th>按鈕</th>
      </tr>
      <tbody id="original">
        @forelse($notice as $notice)
        <form action="{{ url('/companynoticeget/'.$notice->user) }}" method="post" target="_blank" class="noticeform" enctype="multipart/form-data">
          <input type="hidden" id="userid" value="{{$notice->user}}">
          <input type="hidden" id="company_id" name="company_id" value="{{$notice->company_id}}">
          <input type="hidden" id="article_id" name="article_id" value="{{$notice->article_id}}">
          <input type="hidden" id="towho" name="towho" value="applyer">
            <tr>
              <th>
                @if ($notice->towho=='applyer')
                To {{ $notice->name }}
                @else
                From {{ $notice->name }}
                @endif
              </th>
              <th>{{ $notice->atitle }}</th>
              <th>{{ $notice->ntitle }}</th>
              <th>{{ $notice->content }}</th>
              <th>{{ $notice->created_at }}</th>
              @if ($notice->towho=='employer')
              <th><input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="submit" name="submit" value="回覆"></th>
              @else
              <th><input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="submit" name="submit" value="再通知"></th>
              @endif
            </tr>
        </form>

        @empty
        @endforelse
        </tbody>
      </table>
      @if(count($notice) < 1)
        <p>尚無通知信</p>
      @endif

    <div id="results"></div>
    <br><br><br>
    <label>來自FUTURA管理員訊息</label>

    <form action="{{ url('/notices') }}" method="post" target="_blank" >
      <table style="width:90%" border="1px solid black">
        <tr>
          <th>來自</th>
          <th>相關文章</th>
          <th>內容</th>
          <th>時間</th>
          <th>對話</th>
        </tr>
        <tbody>
          @for($i=0; $i<=count($FUTURAnotice)-1; $i++)
            <tr>
              <td>{{ $user[$i] }}</td>
              @if($FUTURAnotice[$i]->article_id !==0 && $FUTURAnotice[$i]->title !== null)
              <td><a href="/detail/{{$FUTURAnotice[$i]->article_id}}">{{ $article[$i] }}</td>
              @else
              <td>無</td>
              @endif
              <td>{{ $FUTURAnotice[$i]->content }}</td>
              <td>{{ $FUTURAnotice[$i]->created_at }}</td>
              <td><a href="/companynotice/{{$company_id}}/talks/{{$FUTURAnotice[$i]->article_id}}">˙˙˙</td>
            </tr>
          @endfor
        </tbody>
      </table>
    </form>



    <script type="text/javascript" src="../js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
