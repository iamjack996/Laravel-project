<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>對話框</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>對話框</h1>
    @if(Auth::check())
      @if($host == 'employer')
        <p>與應徵者的對話</p>
        <a href="/companycenter/{{Auth::user()->id}}">公司中心</a>
        <a href="/internapplicants/{{ $aid }}">上一頁</a>
      @elseif($host == 'applyer')
        <p>與公司的對話</p>
        <a href="/usercenter/{{Auth::user()->id}}">用戶個人中心</a>
        <a href="/applyrecord/{{Auth::user()->id}}">上一頁</a>
      @elseif($host == 'BtoC')
        <p>與FUTURA團隊的對話</p>
        <a href="/companycenter/{{Auth::user()->id}}">公司中心</a>
        <a href="/companynotice/{{Auth::user()->id}}">上一頁</a>
      @elseif($host == 'toB')
        <p>與公司用戶的對話</p>
        <a href="/allarticle">後台</a>
        <a href="/mynotice">上一頁</a>
      @endif
    @endif
    <hr>

    <!-- <div>求職者資訊</div> -->

    <form action="{{ url('/#') }}" id="talksform" enctype="multipart/form-data">
      <div>
        <label>留言</label>
        <textarea name="content" id="content" rows="1" cols="100"></textarea>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="button" id="talks">送出</button>
      </div>
      <br>

      <input type="hidden" id="userid" name="user_id" value="{{$uid}}">
      @if($host == 'employer'||$host == 'applyer')
      <input type="hidden" id="company_id" name="company_id" value="{{$article->user_id}}">
      @else
      <input type="hidden" id="company_id" name="company_id" value="{{$cid}}">
      @endif

      @if($host == 'employer'||$host == 'applyer')
      <input type="hidden" id="article_id" name="article_id" value="{{$aid}}">
      @endif

      @if($host == 'employer')
      <input type="hidden" id="towho" name="towho" value="applyer">
      @elseif($host == 'applyer')
      <input type="hidden" id="towho" name="towho" value="employer">
      @elseif($host == 'BtoC')
      <input type="hidden" id="towho" name="towho" value="toB">
      @elseif($host == 'toB')
      <input type="hidden" id="towho" name="towho" value="BtoC">
      @endif
      <div id="newtalk" align="right" style="width: 1000px;padding: 8px;">
      </div>
      @forelse($notice as $notice)

      @if ($notice->towho==$host)
      <div align="left" style="width: 1000px;padding: 8px;">
      @else
      <div align="right" style="width: 1000px;padding: 8px;">
      @endif

        <span><b>
          @if($notice->towho == 'employer')
          {{ $user->name }}
          @elseif($notice->towho == 'applyer')
          {{ $article->company }}
          @elseif($notice->towho == 'toB')
          {{ Auth::user()->name }}
          @elseif($notice->towho == 'BtoC')
          <span>FUTURA</span>
          @endif
        </b></span>
        <br>
        @if($notice->towho == 'BtoC' && $notice->title !== null && $notice->article_id !== 0)
        <span><small>Re : {{ $notice->title }}</small></span><br>
        @endif

        @if ($notice->towho==$host)
        <span>{{ $notice->content }}</span>
        <span><small><sub>{{ $notice->created_at }}</small></sub></span>
        <span><sub>送出</sub></span>
        @else
        <span><small><sub>{{ $notice->created_at }}</small></sub></span>
        <span><sub>已傳送</sub></span>
        <span>{{ $notice->content }}</span>
        @endif
      </div></div>

      @empty
      <p>尚無對話</p>
      @endforelse
    </form>







    <script type="text/javascript" src = "/../../js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
