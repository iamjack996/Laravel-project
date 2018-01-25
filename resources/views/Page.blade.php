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


<script type="text/javascript" src = "js/app.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
