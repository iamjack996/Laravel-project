<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ $user->name }} 公司資訊</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>{{ $user->name }} 公司資訊頁</h1>
    <a href="/allintern">首頁</a>
    <hr>
    <p>公司名稱 : {{ $user->name }}</p>
    <p>郵件地址 : {{ $user->email }}</p>
    <p>通知回覆率 : {{ $reply }} %</p>
    <p>擁有 {{ $user->numoffollow }} 位追蹤者</p>

    <button id="follow" type="button">
      <span id="newfollowed">
          @if ($followed==0)
          追蹤
          @else
          取消追蹤
          @endif
      </span>
       {{ $user->name }}</button>
    <input type="hidden" id="company" value="{{$user->id}}">
    <input type="hidden" id="followed" value="{{$followed}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <br><br><br><br>
    <h4>= 實習機會 =</h4>
    <label>條件選單</label>
    <select id="typeshow3">
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
    <select id="cityshow3">
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
    <div id="preventshow3">
      @forelse($article as $article)
      <h2>
        {{$article->title}}　<sub>　by <a href="/company/{{$article->user_id}}">{{$article->company}}</a></sub>
      </h2>
      <p><var>{{$article->type}}</var></p>
      <p>位於{{$article->location}}</p>
      <p>待遇${{$article->salt}}</p>
      <p>需求人數{{$article->numofpeople}}</p>
      <p>{{$article->content}}</p>

      <a href="/detail/{{$article->id}}">More..</a>
      <p align="right">發布於{{$article->created_at}} {{ $article->numofapply }}人應徵 {{ $article->numoflike }}人收藏</p>
      <hr>
      @empty($article)
        尚未釋出實習機會
      @endforelse
    </div>

    <div id="showtab3">
    </div>

    <script type="text/javascript" src = "../js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
