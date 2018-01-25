<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>T E S T ! ! !</title>
  </head>
  <body>
    <h1>抓爬蟲結果</h1>


      @for($i=0; $i<=count($job)-1; $i++)
      <p>
        <a href="https://www.1111.com.tw/{{ $job[$i]['url'] }}">{{ $job[$i]['title'] }}</a>

      </p>

      @endfor


  </body>
</html>
