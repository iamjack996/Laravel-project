<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>管理帳戶頁面</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>管理帳戶</h1>
    <a href="/allarticle">後台</a>
    <hr>
    <form action="{{ url('/adminupdate') }}" method="post" id="setadminbox" align="center" hidden>
      <span id="user_name"></span>
      <input type="hidden" name="username" id="username" value="">
      <input type="radio" name="admin" id="admin_2" value="2"> 管理者
      <input type="radio" name="admin" id="admin_1" value="1"> 公司帳戶
      <input type="radio" name="admin" id="admin_0" value="0"> 會員<br>
      <input type="hidden" id="user_id" name="user_id" value="">
      <input type="submit" name="" value="儲存">
      <!-- <button type="button" id="ad_submit">儲存</button> -->
      <button type="button" id="ad_cancel">取消</button>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <hr>
    </form>

    @if (session('msg'))
    <center>
        {{ session('msg') }}
    </center>
    @endif

    <form action="#">
      <table style="width:90%" border="1px solid black" align="center">
        <tr>
          <th>用戶名</th>
          <th>信箱</th>
          <th>追蹤數</th>
          <th>權限</th>
          <th>註冊時間</th>
        </tr>
        <tbody>
          @forelse($user as $user)
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->numoffollow}}人</td>
            <td>
              <a href="{{$user->isAdmin}}/{{$user->name}}/{{$user->id}}" id="setadmin">
                @if($user->isAdmin==2)
                管理者
                @elseif($user->isAdmin==1)
                公司帳戶
                @else
                會員
                @endif
              </a>
            </td>
            <td>{{$user->created_at}}</td>
          </tr>
          @empty
          @endforelse
        </tbody>
      </table>
    </form>



    <script type="text/javascript" src = "js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
