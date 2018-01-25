<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>工作後台</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>@FUTURA管理員後台</h1>
      <a href="/allintern">首頁</a> |
      <a href="/application">FUTURA應用平台</a> |
      <a href="/showreport">檢舉統計</a> |
      <a href="/analyze">實習統計分析</a> |
      <a href="/mynotice">通知信匣</a> |
      <a href="/createcampaign">新增電子報活動</a> |
      <a href="/showdatabase">資料庫</a> |
      <a href="/usersboard">帳戶管理</a> |
      <a href="/set">設定</a>
    <hr>
    <div>
      <button type="button" name="button" id="forlocation">地區排序</button>
      <button type="button" name="button" id="fordeadline">招收截止</button>
      <button type="button" name="button" id="forlasttime">最新實習</button>
      <button type="button" name="button" id="forexpire">過期貼文</button>
      <label>實習地點</label>
      <select id="cityshow">
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
        <label>實習職務類別</label>
        <select id="typeshow">
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
    </div>
    <br>
    <form action="{{ url('/search') }}">
      <input type="text" name="search" id="find" placeholder="Search..">
      <input type="submit" name="submit" id="search" value="搜尋">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    <div id="count">實習貼文數 : {{ $count }}</div>

    <table style="width:90%" border="1px solid black">
      <tr>
        <th>　</th>
        <th>標題</th>
        <th>類別</th>
        <th>單位</th>
        <th>介紹</th>
        <th>截止日</th>
        <th>地點</th>
      </tr>
    </table>
    <form action="{{ url('/destroyarticle') }}" method="post" >
    <div id="preventshow">
      <table style="width:90%" border="1px solid black">
        @forelse($article as $article)
          <tr>
            <th><input type="checkbox" name="articleid[]" value="{{ $article->id }}"></th>
            <th><a href="/updatearticle/{{$article->id}}">{{ $article->title }}</th>
            <th>{{ $article->type }}</th>
            <th>{{ $article->company }}</th>
            <th>{{ $article->detail }}</th>
            <th>{{ $article->deadline }}</th>
            <th>{{ $article->location }}</th>
          </tr>
        @empty
        @endforelse
      </table>
    </div>
    <div> <!--顯示結果app.js-->
    <table id="showtab" style="width:90%" border="1px solid black">
    </table>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" value="刪除" id="destroy">
    </form>
    <div>
      <marquee>這裡放要跑的文字</marquee>
      <marquee direction="right" height="30" scrollamount="10" behavior="alternate">跑馬燈測試</marquee>
    </div>

    <script type="text/javascript" src = "js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
