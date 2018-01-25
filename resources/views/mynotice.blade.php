<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>通知信匣</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>管理者信匣</h1>
    <a href="/allarticle">後台</a>
    <hr>
    <a href="#">寄出備份</a>
    <br><br>

    <table style="width:90%" border="1px solid black">
      <tr>
        <th>用戶</th>
        <th>最新留言</th>
        <th>時間</th>
        <th>對話</th>
      </tr>
      <tbody>
        @forelse($notice as $notice)
          <tr>
            <td><a href="/company/{{$notice->company_id}}}">{{ $notice->name }}</td>
            @if($notice->towho == 'toB')
            <td><b>{{ $notice->content }}</b></td> <!--粗體 -->
            @else
            <td><var>{{ $notice->content }}</var></td> <!--斜體 -->
            @endif
            <td>{{ $notice->created_at }}</td>
            <td><a href="/mynotice/{{$notice->company_id}}">˙˙˙</td>
          </tr>
        @empty
        @endforelse


      </tbody>



    </table>




    <script type="text/javascript" src = "js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
