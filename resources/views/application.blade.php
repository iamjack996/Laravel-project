<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>應用頁面</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>應用平台</h1>
    <a href="/allarticle">後台</a>
    <hr>
    <br>
    <center>
    <p>
    過去24小時有 <big>{{ $counttoday }}</big> 則新實習
    過去一週內有 <big>{{ $countweek }}</big> 則新實習
    過去一個月有 <big>{{ $countmonth }}</big> 則新實習
    </p>
    </center>
    <br>

    <form action="{{ url('/#') }}">
      <input type="text" name="search" id="keyword" placeholder="Search..">　
      <select id="jobcity">
        <option value="">選擇地點</option>
        <option value="台北市">台北市</option>
        <option value="新北市">新北市</option>
        <option value="基隆">基隆</option>
        <option value="桃園">桃園</option>
        <option value="新竹">新竹</option>
        <option value="苗栗">苗栗</option>
        <option value="台中市">台中市</option>
        <option value="彰化">彰化</option>
        <option value="南投">南投</option>
        <option value="雲林">雲林</option>
        <option value="嘉義">嘉義</option>
        <option value="台南市">台南市</option>
        <option value="高雄市">高雄市</option>
        <option value="屏東">屏東</option>
        <option value="宜蘭">宜蘭</option>
        <option value="花蓮">花蓮</option>
        <option value="台東">台東</option>
        <option value="外島">外島</option>
        <option value="其他">其他</option>
      </select>
      <select id="jobtype">
        <option value="">選擇職務</option>
        <option value="資訊工程">資訊工程</option>
        <option value="行銷企劃">行銷企劃</option>
        <option value="餐飲旅遊">餐飲旅遊</option>
        <option value="學術教育">學術教育</option>
        <option value="營建製圖">營建製圖</option>
        <option value="財務金融">財務金融</option>
        <option value="行政客服">行政客服</option>
        <option value="生產製造">生產製造</option>
        <option value="傳播設計">傳播設計</option>
        <option value="其他">其他</option>
      </select>　

      <input type="submit" name="submit" id="findarticle" value="找文章">
      <button type="button" id="fincompany">找公司</button>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    <div id="count">在線總實習數 : {{ $count }}</div>
    <form action="{{ url('/notices') }}" method="post" target="_blank" >
      <input name="clickAll" id="clickAll" type="checkbox"> 全選
      <table style="width:90%" border="1px solid black">
        <tr>
          <th>選取</th>
          <th>職類</th>
          <th>文章標題</th>
          <th>公司</th>
          <th>應徵數</th>
          <th>收藏數</th>
          <th>發布時間</th>
          <th>截止日</th>
          <th>舉報數</th>
          <th>置頂</th>
        </tr>
        <tbody id="prevent">
        @for($i=0; $i<=count($article)-1; $i++)
          <tr>
            <td><input type="checkbox" name="articleid[]" value="{{ $article[$i]->id }}"></td>
            <td>{{ $article[$i]->type }}</td>
            <td><a href="/detail/{{$article[$i]->id}}">{{ $article[$i]->title }}</td>
            <td><a href="/company/{{$article[$i]->user_id}}">{{ $article[$i]->company }}</td>
            <td>{{ $article[$i]->numofapply }}人</td>
            <td>{{ $article[$i]->numoflike }}人</td>
            <td>{{ $article[$i]->created_at }}</td>
            <td>{{ $article[$i]->deadline }}</td>
            <td><a href="/showreport/{{$article[$i]->id}}">{{ $reportnum[$i] }}</td>
            <td>
              @if($article[$i]->hot==1)
              √
              @else
              ×
              @endif
            </td>
          </tr>
        @endfor
        </tbody>
        <tbody id="results"></tbody>
      </table>

      <button type="button" id="top">置頂</button>
      <button type="button" id="notop">取消置頂</button>
      <input type="hidden" id="towho" name="towho" value="BtoC">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" name="submit" id="notices" value="通知" >
    </form>



    <script type="text/javascript" src = "js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
