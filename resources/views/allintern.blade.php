<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Ｆｕｔｕｒａ - 首頁</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>@FUTURA找尋你想要的實習工作</h1>

    @if(Auth::check())
      @if(Auth::user()->isAdmin == 2)
      <div align="right">
        {{ Auth::user()->name}} 已登入<br>
        <a href="/allarticle">管理員後台</a><br>
        <a href="/usercenter/{{Auth::user()->id}}">個人中心</a><br>
        <a href="/companycenter/{{Auth::user()->id}}">公司用戶中心</a><br>
      </div>
      @endif
      @if(Auth::user()->isAdmin == 1)
      <div align="right">
        {{ Auth::user()->name}} 已登入<br>
        <a href="/companycenter/{{Auth::user()->id}}">公司用戶中心</a><br>
      </div>
      @endif
      @if(Auth::user()->isAdmin == 0)
      <div align="right">
        {{ Auth::user()->name}} 已登入<br>
        <a href="/usercenter/{{Auth::user()->id}}">用戶個人中心</a><br>
      </div>
      @endif
    @endif

    <div align="right">
      <a href="/email">訂閱電子報</a><br>
      <a href="/login">登入頁面</a><br>
    </div>

    <hr>
    <div align="center">
      <a href="/fullsearch" target="_blank"><h3>搜尋含外部網域實習爬蟲</h3></a>
    </div>
    <hr>
    <center>
      <h3><sup>HOT</sup>最多關注實習</h3>
      @forelse($hotarticle as $hotarticle)
      <b><big><a href="/detail/{{$hotarticle->id}}">{{$hotarticle->title}}</a></big></b>
      {{$hotarticle->company}}
      <br>
      @empty
      @endforelse
    </center>
    <hr>
    <div>
      <form action="{{ url('/#') }}">
        <input type="text" name="search" id="keywordindex" placeholder="Search..">　

        <select id="typeshow2">
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
        <select id="cityshow2">
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
        <input type="submit" name="submit" id="search2" value="搜尋">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </form>


    </div>

    <br>
    <button type="button" name="button" id="forlocation2">地區排序</button>


    <div id="preventshow2">
      @forelse($articles as $article)
      <h2>
        @if($article->hot==1)<sup><small>置頂　</small></sup>@endif
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
      @empty
      @endforelse
      {!! $articles->links() !!}
    </div>
    <div id="showtab2">
    </div>




    @if (session('msg'))
    <div>
        {{ session('msg') }}
    </div>
    @endif



    <script type="text/javascript" src = "js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


  </body>
</html>
