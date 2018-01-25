<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $article->title }} - FUTURA</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
      #detail-map {
        height: 400px;
        width: 400px;
       }
    </style>
  </head>
  <body>
    <h1>{{ $article->title }}</h1>
    <div align="right">
      {{ $article->numofapply }}人應徵 {{ $article->numoflike }}人收藏
    </div>
    <a href="/allintern">首頁</a>
    <hr>

    <div align="right">
      <button type="button" name="button" id="shareurl">分享網址</button>
      <button type="button" name="report" id="report">檢舉！</button>
    </div>
    <div align="center" id="reportmsg"></div>

    <form id="reportform" align="center" hidden>
      <input type="hidden" name="id" id="re_article_id" value="{{$article->id}}">
      <div>
        檢舉文章 : <input type="text" name="article_title" id="re_article_title" value="{{$article->title}}" readonly>
      </div>
      <div>
        原因 : <span id="showtest"> </span><br>
        <input type="radio" name="reason" value="待遇不合理"> 待遇不合理
        <input type="radio" name="reason" value="要求不合理"> 要求不合理
        <input type="radio" name="reason" value="其他"> 其他
      </div>
      <div>
        描述內容 : <br>
        <textarea rows="4" cols="36" id="re_report_content">{{ old('skill') }}</textarea>
      </div>
      <input type="hidden" name="user_id" id="re_user_id" value="">
      <input type="hidden" name="company_id" id="re_company_id" value="{{$article->user_id}}">
      <input type="hidden" name="article_type" id="re_article_type" value="{{$article->type}}">
      <input type="hidden" name="article_company" id="re_article_company" value="{{$article->company}}">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      {{ csrf_field() }}
      <input type="submit" name="submit" id="subreport" value="回報">
      <button type="button" name="button" id="re_cancel">取消</button>
      <hr>
    </form>

    <form id="detailform">

      <input type="hidden" name="id" id="articleid" value="{{$article->id}}">
      <p>公司名稱 <a href="/company/{{$article->user_id}}">{{ $article->company }}</a></p>
      <p>分類 {{ $article->type }}</p>
      <p>地點 {{ $article->location }}</p>
      <p>地址 {{ $article->address }}</p>
      <p>期限 {{ $article->deadline }}</p>
      <p>性質 {{ $article->howlong }}</p>
      <p>內容 {{ $article->content }}</p>
      <p>人員需求 {{ $article->numofpeople }}</p>
      <p>技術要求 {{ $article->skill }}</p>
      <p>詳細介紹 {{ $article->detail }}</p>
      <p>待遇 {{$article->salt}} 元/月</p>

      <div id="detail-map" ></div>

      <p align="right">發布於{{ $article->created_at }}</p>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <button type="button" id="collecte" name="button">加入收藏</button><br>
      <button type="button" id="apply" name="button">應徵實習</button>
    </form>

    <div id="msg"></div>

    <hr>
    <h4>其他同性質的實習 - 推薦</h4>
    @forelse($recommend as $recommend)

    <p>
      <a href="/detail/{{$recommend->id}}">{{ $recommend->title }}</a>
      <span> by {{ $recommend->company }}</span>
      <span> in {{ $recommend->location }}</span>
    </p>

    @empty
    @endforelse

    <div class="fb-comments" data-href="http://127.0.0.1:8000/detail/{{ $article->id }}" data-width="700" data-numposts="5"></div>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.10&appId=178339842661910";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <script>
      function initMap() {
        var lat = {{ $article->maplat }};
        var lng = {{ $article->maplng }};

        var map = new google.maps.Map(document.getElementById('detail-map'), {
          zoom: 15,
          center: {
            lat:lat,
            lng:lng
          }
        });
        var marker = new google.maps.Marker({
          position: {
            lat:lat,
            lng:lng
          },
          map: map,
        });

      }
    </script>


    <script type="text/javascript" src = "../js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEzABybtc9h0JuIYoREsSCJ7oJBWDq9GQ&callback=initMap&libraries=places">
    </script>

  </body>
</html>
