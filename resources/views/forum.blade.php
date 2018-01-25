<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>亂 寫</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h3><b>熱門趨勢</b></h3>
    <label>Yahoo!</label>
    <div class="">
      @for($i=0; $i<=12-1; $i++)
      <span><a href="{{ $yahoo[$i]['url'] }}">{{ $yahoo[$i]['hotword'] }}</a></span>
      @endfor
    </div>
    <br>

    <img src="http://data.yamaha.jp/sdb/product/image/main/medium/c/cl3/C1A5242021994B2B945144D9E45F0198_12001.jpg" alt="">

    <div>


      @forelse($test as $test)
      <img src="uploads/{{$test->img1}}">
      <br>
      <span>{{ $test->title }}</span><br>
      @empty
      @endforelse
    </div>
    <form action="{{ url('/upload') }}" method="post" enctype="multipart/form-data">
      <label>描述說明</label><br>
      <input type="text" name="title" value=""><br>
      <label>上傳相片</label>
      <input type="file" name="img1" value="">
      <label>上傳影片</label>
      <input type="file" name="video1" value="">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" name="submit" value="上傳">
    </form>





    <script type="text/javascript" src = "js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
