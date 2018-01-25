<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Adding New Internship in Here</title>
    <style>
      #map {
        height: 400px;
        width: 400px;
       }
    </style>
  </head>
  <body>
    <div>新增實習貼文，這個網頁是用來建立實習的文章內容。</div>
    <form action="{{ url('/updatearticle/'.$article->id) }}" method="post">Add a new article.
      <div>
        <label>實習標題</label>
        <input type="text" name="title" value="{{ $article->title }}">
      </div>
      <div>
        <label>實習內容</label>
        <textarea name="content" rows="4" cols="36" >{{ $article->content }}</textarea>
      </div>
      <div>
        <label>截止時間</label>
        <input type="date" name="deadline" value="{{ $article->deadline }}">
      </div>
      <div>
        <input type="hidden" name="user_id" value="{{ $article->user_id }}">
      </div>
      <div>
        <label>詳細介紹</label>
        <textarea name="detail" rows="6" cols="36" >{{ $article->detail }}</textarea>
      </div>
      <div>
        <label>實習地點</label>
        <input list="city" name="location" value="{{ $article->location }}">
          <datalist id="city">
            <option value="台北市">
            <option value="新北市">
            <option value="基隆">
            <option value="桃園">
            <option value="新竹">
            <option value="苗栗">
            <option value="台中市">
            <option value="彰化">
            <option value="南投">
            <option value="雲林">
            <option value="嘉義">
            <option value="台南市">
            <option value="高雄市">
            <option value="屏東">
            <option value="宜蘭">
            <option value="花蓮">
            <option value="台東">
            <option value="外島">
            <option value="其他">
          </datalist>
      </div>
      <div>
        <label>工作地址</label>
        <input type="text" name="address" value="{{ $article->address }}">
      </div>
      <div>
        <label>需求人數</label>
        <input list="peo" name="numofpeople" value="{{ $article->numofpeople }}">
          <datalist id="peo">
            <option value="1~3人">
            <option value="4~6人">
            <option value="6~10人">
            <option value="10人以上">
          </datalist>
      </div>
      <div>
        <label>職務類型</label>
        <input list="type" name="type" value="{{ $article->type }}">
          <datalist id="type">
            <option value="資訊工程">
            <option value="行銷企劃">
            <option value="餐飲旅遊">
            <option value="學術教育">
            <option value="營建製圖">
            <option value="財務金融">
            <option value="行政客服">
            <option value="生產製造">
            <option value="傳播設計">
            <option value="其他">
          </datalist>
      </div>
      <div>
        <label>期間性質</label>
          <input list="time" name="howlong" value="{{ $article->howlong }}">
            <datalist id="time">
              <option value="寒暑假(短期)">
              <option value="學期/年制(長期)">
            </datalist>
      </div>
      <div>
        <label>技能要求</label>
        <textarea name="skill" rows="4" cols="36" >{{ $article->skill }}</textarea>
      </div>
      <div>
        <label>待遇(月薪為準)</label>
        <input type="text" name="salt" id="salt" value="{{ $article->salt }}" placeholder="輸入月薪待遇"> 月薪
        <br>
        <input type="text" id="hours" placeholder="輸入時薪待遇自動轉換"> 時薪
      </div>
      <div><label>上傳相片</label></div>
      <div>
        <input type="file" name="img1" value="{{ $article->imge1 }}">
      </div>
      <div>
        <input type="file" name="img2" value="{{ $article->imge2 }}">
      </div>
      <div>
        <input type="file" name="img3" value="{{ $article->imge3 }}">
      </div>

      <div>
        <label>Google Map</label>
        <input type="text" id="searchmap" placeholder="Search..">
        <div id="map"></div>
        <input type="text" name="maplat" id="lat" value="{{ $article->maplat }}">
        <input type="text" name="maplng" id="lng" value="{{ $article->maplng }}">
      </div>

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" name="submit" value="修改完成">
    </form>
    <form action="{{ url('/deletearticle/'.$article->id) }}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" name="submit" value="刪除文章">
    </form>

    <script>
      function initMap() {
        var uluru = {lat: {{ $article->maplat }}, lng: {{ $article->maplng }}};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          draggable :true
        });

        var searchmap = new google.maps.places.SearchBox(document.getElementById('searchmap'));

        google.maps.event.addListener(searchmap,'places_changed',function(){
          var places = searchmap.getPlaces();
          var bounds = new google.maps.LatLngBounds();
          var i,place;
          for(i=0;place=places[i];i++){
            bounds.extend(place.geometry.location);
            marker.setPosition(place.geometry.location);
          }

          map.fitBounds(bounds);
          map.setZoom(15);
        });

        google.maps.event.addListener(marker,'position_changed',function(){
          var lat = marker.getPosition().lat();
          var lng = marker.getPosition().lng();

          $("#lat").val(lat);
          $("#lng").val(lng);

        });

        service = new google.maps.places.PlacesService(map);
        service.nearbySearch(request, callback);


      }
    </script>

    <script type="text/javascript" src = "../js/app.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEzABybtc9h0JuIYoREsSCJ7oJBWDq9GQ&callback=initMap&libraries=places">
    </script>

  </body>
</html>
