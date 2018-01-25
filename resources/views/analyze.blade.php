<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>實習文章統計分析</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>實習文章統計分析</h1>
    <a href="/allarticle">後台</a>
    <hr>

    <div>
      <h4>最熱門應徵職類</h4>
      @forelse($hotapply as $hotapply)
      <b>{{$hotapply->article_type}}</b>
      {{$hotapply->counthottype}} <br>
      @empty
      @endforelse
    </div>

    <div>
      <h4>近期熱門應徵職類(一週內)</h4>
      @forelse($latelyhotapply as $latelyhotapply)
      <b>{{$latelyhotapply->article_type}}</b>
      {{$latelyhotapply->latelycounthottype}} <br>
      @empty
      <small>// 近期一週內無應徵紀錄 //</small>
      @endforelse
    </div>

    <div>
      <h4>最多收藏數職類</h4>
      @forelse($hotcollect as $hotcollect)
      <b>{{$hotcollect->article_type}}</b>
      {{$hotcollect->counthottype}} <br>
      @empty
      @endforelse
    </div>

    <div>
      <h4>最熱門追蹤公司</h4>
      @forelse($hotcompany as $hotcompany)
      <b><a href="/company/{{$hotcompany->id}}">{{$hotcompany->name}}</a></b>
      {{$hotcompany->numoffollow}} <br>
      @empty
      @endforelse
    </div>

    <div>
      <h4>最多實習縣市</h4>
      @forelse($article_at as $article_at)
      <b>{{$article_at->location}}</b>
      {{$article_at->countcity}} <br>
      @empty
      @endforelse
    </div>





    <script type="text/javascript" src = "js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
