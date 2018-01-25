<?php
namespace App\Http\Controllers;

use Carbon\carbon;
use App\Model2\article;
use App\Model2\collection;
use App\Model2\apply;
use App\Model2\users;
use App\Model2\order;
use App\Model2\notice;
use App\Model2\report;
use App\Model2\follow;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Eventviva\ImageResize;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Auth;
use DB;
use Illuminate\Pagination\Paginator;

use App\Notifications\Testnotify;
use App\Thread;

use Symfony\Component\DomCrawler\Crawler; //for爬蟲 27-29
use Goutte\Client;
use Goutte;
use Storage;

class internController extends Controller {

    private $now;

    public function __construct(Client $client)
    {
      $time = Carbon::now();
      $time->timezone = new \DateTimeZone('Asia/Taipei');
      $time = $time->format('Y-m-d\TH:i:s');

      $this->now = $time;
      $this->client = $client;
    }

    public function index()
    {
      $now = $this->now;

      $article = article::orderBy('created_at','desc')
      ->where('deadline','>=',$now)->get();

      $count = article::where('id','!=',null)
      ->where('deadline','>=',$now)->count();

      return view('allarticle', array('article' => $article, 'count' => $count));
    }

    public function addarticle($id)
    {
      $company = users::where('id','=',$id)->value('name');
      return view('addarticle',array('user_id' => $id,'company' => $company));
    }

    public function addarticlepost(Request $request)
    {
      $messages = array(
          'title.required'=>'標題欄位不能為空',
          'title.max'=>'標題最長長度為 :max 字元',
          'content.required'=>'內容欄位不能為空',
          'content.max'=>'內容最長長度為 :max 字元',
          'deadline.required'=>'截止時間欄位不能為空',
          'deadline.date'=>'截止時間欄位格式錯誤',
          'deadline.after'=>'截止時間不能為今天以前',
          'company.required'=>'單位簡介欄位不能為空',
          'company.max'=>'單位簡介最長長度為 :max 字元',
          'detail.required'=>'詳細介紹欄位不能為空',
          'detail.max'=>'詳細介紹最長長度為 :max 字元',
          'location.required'=>'請選擇實習地點',
          'address.required'=>'請輸入工作地址',
          'numofpeople.required'=>'請選擇需求人數',
          'type.required'=>'請選擇職務類型',
          'howlong.required'=>'請選擇期間性質',
          'skill.required'=>'技能要求欄位不能為空',
          'skill.max'=>'技能要求最長長度為 :max 字元',
          'salt.required'=>'待遇欄位不能為空',
          'salt.max'=>'待遇必須填上整數',
          'img1.max'=>'超過圖片上傳的限制大小:maxKB',
          'img1.image'=>'只能上傳圖片格式（jpeg、png、bmp、gif、svg）',
          'img2.max'=>'超過圖片上傳的限制大小:maxKB',
          'img2.image'=>'只能上傳圖片格式',
          'img3.max'=>'超過圖片上傳的限制大小:maxKB',
          'img3.image'=>'只能上傳圖片格式',
      );
      $rules = array(
          'title' => 'required|max:25',
          'content' => 'required|max:700',
          'deadline' => 'required|date|after:today',
          'company' => 'required|max:300',
          'detail' => 'required|max:700',
          'location' => 'required',
          'address' => 'required',
          'numofpeople' => 'required',
          'type' => 'required',
          'howlong' => 'required',
          'skill' => 'required|max:300',
          'salt' => 'required|integer',
          'img1' => 'max:5120|image',
          'img2' => 'max:5120|image',
          'img3' => 'max:5120|image'
      );

      $validator = Validator::make($request->all(),$rules,$messages);


      if($validator->fails()){
        return redirect('/addarticle/'.$request->user_id)
          ->withErrors($validator,'messages')
          ->withInput();
      }
      else{
      $now = $this->now;

      $article = new article($request->all());
      $article->created_at = $now;

      if($request->hasFile('img1')){ //新套件才有安裝
        if($request->file('img1')->isValid()){
          $size = getimagesize($request->img1);
          $width = $size[0];
          $height = $size[1];
          if($width > 340 && $height > 170){
            $resize = new ImageResize($request->img1);
            $reimage = $resize->resize(340,170);
            $article->img1 = base64_encode($reimage);
            }
          $article->img1 = base64_encode(file_get_contents($request->img1->getRealPath()));
        }
      }

      $article->save();
      return redirect('/applyerrecord/'.$request->user_id);
      }
    }

    public function updatearticle($id)
    {
      $article = article::find($id);
      return view('updatearticle', array('article' => $article));
    }

    public function updatearticlepost(Request $request,$id)
    {
      $now = $this->now;

      $article = article::find($id)
      ->update($request->all(),['updated_at' => $now]);
      // ->update($request->all());

      return redirect('/applyerrecord/'.$request->user_id);
    }

    public function deletearticlepost($id)
    {
      $article = article::find($id);
      article::destroy($id);
      return redirect('allarticle');
    }

    public function Btnforlocation()
    {
      $now = $this->now;

      $article = order::orderBy('order.id')
      ->join('article','article.location','=','order.city')
      ->where('article.deadline','>=',$now)
      ->get();

      $count = article::where('id','!=',null)
      ->where('deadline','>=',$now)->count();
      $results = array('article' => $article, 'count' => $count);
      return $results;
    }

    public function Btnfordeadline()
    {
      $now = $this->now;

      $article = article::orderBy('deadline', 'asc')
      ->where('deadline','>=',$now)->get();
      $count = article::where('id','!=',null)
      ->where('deadline','>=',$now)->count();
      $results = array('deadline' => $article, 'count' => $count);
      return $results;
    }

    public function Btnforlasttime()
    {
      $now = $this->now;

      $article = article::orderBy('created_at', 'desc')
      ->where('deadline','>=',$now)->get();
      $count = article::where('id','!=',null)
      ->where('deadline','>=',$now)->count();
      $results = array('lasttime' => $article, 'count' => $count);
      return $results;
    }

    public function forexpire()
    {
      $now = $this->now;

      $article = article::orderBy('deadline','desc')
      ->where('deadline','<',$now)
      ->get();
      $count = article::where('deadline','<',$now)->count();

      $results = array('article' => $article, 'count' => $count);
      return $results;
    }

    public function search(Request $request) //allarticle
    {
      $now = $this->now;

      $ans = $request->ans;
      $ans1 = $request->ans1;
      $ans2 = $request->ans2;

      $article = article::where('title','like','%'.$ans.'%')
      ->where('deadline','>=',$now)
      ->get();
      // $article = article::where('title','=',$request->search)->get();
      // return view('showarticle', array('ans' => $article));
      $results = array('article' => $article);
      return $results; //Request::wantsJson()
    }

    public function forcity(Request $request)
    {
      $now = $this->now;

      $article = article::where('location','=',$request->forcity)
      ->where('deadline','>=',$now)->get();
      $results = array('article' => $article);
      return $results;
    }

    public function detail($id)
    {
      $now = $this->now;

      $article = article::find($id);
      $recommend = article::where('type',$article->type)
      ->where('deadline','>=',$now)->where('id','!=',$id)->take(5)->get();

      return view('detail', array('article' => $article,'recommend' => $recommend));
    }

    public function addtocollection(Request $request)
    {
      $now = $this->now;

      $user = Auth::user();

      if(isset($user)){
        $collection = collection::where('user_id','=',$user->id)
        ->where('article_id','=',$request->id)->count();
        if($collection>0){
          $collecteok = 0;
        }else{
          $article = article::where('id','=',$request->id)->first();

          $collections = new collection;
          $collections->user_id = $user->id;
          $collections->company_id = $article->user_id;
          $collections->article_id = $request->id;
          $collections->article_title = $article->title;
          $collections->article_type = $article->type;
          $collections->article_company = $article->company;
          $collections->article_location = $article->location;

          $collections->created_at = $now;
          $collections->save();

          article::find($request->id)->increment('numoflike', 1);

          $collecteok = 1;
        }
        $userexist = 1;
      }else{
        $collecteok = 0;
        $userexist = 0;
      }

      $results = array('collecteok' => $collecteok,'userexist' => $userexist);
      return $results;
    }


    public function searchselect(Request $request) //city+type select 2
    {
      $now = $this->now;

      $ans1 = $request->ans1;
      $ans2 = $request->ans2;

      $article = article::where('type','like','%'.$ans2.'%')
      ->where('deadline','>=',$now)
      ->where('location','like','%'.$ans1.'%')
      ->orderBy('created_at','desc')->get();
      $count = article::where('type','like','%'.$ans2.'%')
      ->where('location','like','%'.$ans1.'%')
      ->where('deadline','>=',$now)->count();

      $results = array('article' => $article,'count' => $count);
      return $results;
    }

    public function searchselect2(Request $request) //city+type+searchbox (allintern)
    {
      $now = $this->now;

      $ans1 = $request->ans1;
      $ans2 = $request->ans2;
      $ans3 = $request->ans3;

      $article = article::where('title','like','%'.$ans3.'%')
      ->where('deadline','>=',$now)
      ->where('location','like','%'.$ans1.'%')
      ->where('type','like','%'.$ans2.'%')
      ->orderBy('created_at','desc')->get();

      $results = array('article' => $article,'ans' => $ans3);
      return $results;
    }

    public function searchselect3(Request $request) //city+type (company)
    {
      $now = $this->now;

      $ans1 = $request->ans1;
      $ans2 = $request->ans2;
      $ans3 = $request->ans3;

      $article = article::where('type','like','%'.$ans2.'%')
      ->where('deadline','>=',$now)
      ->where('location','like','%'.$ans1.'%')
      ->where('user_id',$ans3)
      ->orderBy('created_at','desc')->get();

      $results = array('article' => $article);
      return $results;
    }

    public function searchmap(Request $request)
    {
      Mapper::location($request->ans)->map(['zoom' => 15, 'markers' => ['title' => 'My Location', 'animation' => 'DROP'], 'clusters' => ['size' => 50, 'center' => true, 'zoom' => 20]]);

    }

    public function usercenter($id)
    {
      $user = users::find($id);
      $follow = follow::where('user_id',$id)->count();
      return view('usercenter', array('user' => $user,'follow' => $follow));
    }

    public function applythis(Request $request)
    {
      $now = $this->now;

      $user = Auth::user();
      if(isset($user)){
        $userexist = 1;
        $user_id = $user->id;
        $apply = apply::where('user_id','=',$user_id)
        ->where('article_id','=',$request->id)->count();
        if($apply>0){
          $applyok = 0;
        }else{
          $article = article::where('id','=',$request->id)->first();

          $applys = new apply();
          $applys->article_id = $request->id;
          $applys->user_id = $user_id;
          $applys->company_id = $article->user_id;
          $applys->article_title = $article->title;
          $applys->article_type = $article->type;
          $applys->article_company = $article->company;
          $applys->article_location = $article->location;

          $applys->created_at = $now;
          $applys->save();

          article::find($request->id)->increment('numofapply', 1);
          $applyok = 1;
        }
      }else{
        $applyok = 0;
        $userexist = 0;
      }

      $results = array('applyok' => $applyok,'userexist' => $userexist);
      return $results;
    }

    public function applyrecord($id)
    {
      $now = $this->now;

      $apply = apply::where('user_id','=',$id)->get();
      $apply2 = apply::where('user_id','=',$id)->pluck('article_id')->toArray();

      $array = array();
      $array2 = array();
      for($i=0;$i<count($apply2);$i++){
        $article = article::where('id',$apply2[$i])->value('deadline');
        $article2 = article::where('id',$apply2[$i])->value('salt');
        $array = array_add($array,$i,$article);
        $array2 = array_add($array2,$i,$article2);
      }

      return view('applyrecord', array('now' => $now,'apply' => $apply,'apply_user_id' => $id,'article' =>$array,'article2' =>$array2));
    }

    public function collecterecord($id)
    {
      $now = $this->now;

      $collection = collection::where('user_id','=',$id)->get();
      $collection2 = collection::where('user_id','=',$id)->pluck('article_id')->toArray();

      $array = array();
      $arraysalt = array();
      for($i=0;$i<count($collection2);$i++){
        $article = article::where('id',$collection2[$i])->value('deadline');
        $articlesalt = article::where('id',$collection2[$i])->value('salt');
        $array = array_add($array,$i,$article);
        $arraysalt = array_add($arraysalt,$i,$articlesalt);
      }
      return view('collecterecord', array('now' => $now,'collection' => $collection,'user_id' => $id,'article' =>$array,'articlesalt' =>$arraysalt));
    }

    public function deleteapply(Request $request)
    {
      $apply_id = $request->applyid;

      if(is_array($apply_id)){
        $apply = apply::find($apply_id)->first();
        article::find($apply->article_id)->decrement('numofapply', 1);
        apply::destroy($apply_id);
      }
      return redirect('/applyrecord/'.$request->user_id);
    }

    public function deletecollection(Request $request)
    {
      $collection_id = $request->collectionid;

      if(is_array($collection_id)){
        $collection = collection::where('id',$collection_id)->first();
        article::find($collection->article_id)->decrement('numoflike', 1);
        collection::destroy($collection_id);
      }
      return redirect('/collecterecord/'.$request->user_id);
    }

    public function destroyarticle(Request $request)
    {
      $article_id = $request->articleid;

      if(is_array($article_id)){
        $article = article::find($article_id);
        article::destroy($article_id);
      }
      return redirect('allarticle');
    }

    public function companycenter($id)
    {
      if (Auth::check()) {  //問題 改寫到中介層
        if(Auth::user()->isAdmin > 0)
        {
          $user = users::find($id);
          return view('companycenter', array('user' => $user));
        }
        return redirect('home')->with('msg','You have not admin access');
      }
      return redirect('home')->with('msg','You have not admin access');
    }

    public function applyerrecord($id) //user_id(company)
    {
      $now = $this->now;

      $article = article::where('user_id',$id)->get();
      // $article_id = article::where('user_id',$id)
      // ->pluck('id')->toArray();
      //
      // $array = array();
      // if(is_array($article_id)){ //if只會跑一次
      //
      //   for($i=0; $i<count($article_id);$i++){  //VIEW同個迴圈兩個變數
      //     $countapply = apply::where('company_id','=',$id)
      //     ->where('article_id','=',$article_id[$i])->count();
      //     $array = array_add($array,$i,$countapply);
      //   }
      // }

      return view('applyerrecord', array('now'=> $now ,'article' => $article,'apply_user_id' => $id));
    }

    public function internapplicants($id) //傳入文章id
    {
      $apply = apply::where('article_id','=',$id)->pluck('user_id'); //user_id//lists remove from 5.3


      $users = apply::where('apply.article_id','=',$id)
      ->select('users.id','users.name','users.email','apply.created_at','apply.notice') //join notice拿掉了
      ->join('users','apply.user_id','=','users.id')
      ->whereIn('users.id',$apply)
      ->get();

      $article = article::where('id','=',$id)->first();

      return view('internapplicants', array('users' => $users,'article' => $article,'article_id' => $id));
    }

    public function noticeapplicants(Request $request, $id) //user_id(company)
    {
      $article_id = $request->article_id;

      $user_id = $request->applicantsid;

      return view('noticescript', array('article_id' => $article_id, 'company_id' => $id, 'user_id' => $user_id));
    }

    public function notice(Request $request, $id) //article_id
    {

      $input = $request->all();

      for($i=0; $i<= count($request->user_id); $i++) {
        $now = Carbon::now();
        $now->timezone = new \DateTimeZone('Asia/Taipei');
        $now = $now->format('Y-m-d\TH:i:s');

        $who = 'applyer';

        if(empty($request->user_id[$i]) || !is_numeric($request->user_id[$i])) continue;

        $data = [
          'company_id' => $request->company_id,
          'article_id' => $id,
          'towho' => $who,
          'title' => $request->title,
          'content' => $request->content,
          'created_at' => $now,
          'user_id' => intval($request->user_id[$i])
        ];

        notice::create($data);

        apply::where('article_id', $id)
          ->where('user_id', $request->user_id[$i])
          ->update(['notice' => 1]);
      }

      return redirect('/internapplicants/'.$id);
    }

    public function companynotice($id) //company_id
    {
      $notice = users::join('notice','users.id','=','notice.user_id')
      ->select('notice.towho','notice.user_id as user','users.name','article.title as atitle','notice.title as ntitle','notice.content','notice.created_at','notice.company_id','notice.article_id','article.company')
      ->join('article','article.id','=','notice.article_id')
      ->where('notice.company_id','=',$id)
      ->whereNotIn('towho',['BtoC','toB'])
      ->orderBy('notice.created_at','desc')
      ->take(10)->get();
      $select = article::where('user_id','=',$id)->get();

      $FUTURAnotice = notice::where('company_id',$id)
      ->where('towho','BtoC')
      ->orderBy('created_at','desc')->get();

      $fu_article_id = notice::where('company_id',$id)
      ->where('towho','BtoC')
      ->orderBy('created_at','desc')
      ->pluck('article_id')->toArray();

      $fu_user_id = notice::where('company_id',$id)
      ->where('towho','BtoC')
      ->orderBy('created_at','desc')
      ->pluck('user_id')->toArray();

      $article_title = array();
      $user_name = array();
      for($i=0;$i<count($FUTURAnotice);$i++){
        $article = article::where('id',$fu_article_id[$i])->value('title');
        $user = users::where('id',$fu_user_id[$i])->value('name');
        $article_title = array_add($article_title,$i,$article);
        $user_name = array_add($user_name,$i,$user);
      }
      return view('companynotice',array('company_id' => $id,'notice' => $notice,'title' => $select,'FUTURAnotice' => $FUTURAnotice,'article' => $article_title,'user' => $user_name));
    }

    public function companynoticeget(Request $request,$id) //user_id
    {
      $company_id = $request->company_id;
      $article_id = $request->article_id;
      $towho = $request->towho;

      return view('companynoticeget',array('user_id' => $id,'company_id' => $company_id,'article_id' => $article_id,'towho' => $towho));

      // $notice = $request->ans;
      // $results = array('notice' => $notice);
      // return $results;
    }

    public function companynoticepost(Request $request,$id) //article_id
    {
      $now = $this->now;

      $notice = new notice($request->all());
      $notice->created_at = $now;
      $notice->save();

      return Redirect('close');
    }

    public function notices(Request $request)
    {
      $towho = $request->towho;
      if(count($request->articleid)==0){
        $msg = "未選取目標";
        return view('fail',array('msg' => $msg));
      }
      $article_id = $request->articleid;
      $article = article::whereIn('id',$article_id)->get();

      auth()->user()->notify(new Testnotify());

      return view('notices',array('towho' => $towho,'article' => $article));
    }

    public function noticespost(Request $request)
    {
      $now = $this->now;

      foreach ($request->article_id as $article_id) {
        $company_id = article::where('id',$article_id)->value('user_id');
        $title = article::where('id',$article_id)->value('title');

        $notice = new notice($request->except('article_id'));
        $notice->title = $title;
        $notice->article_id = $article_id;
        $notice->company_id = $company_id;
        $notice->created_at = $now;
        $notice->save();
      }
      return Redirect('close');
    }

    public function foruser(Request $request)
    {
      $company_id = $request->ans1;

      $notice = users::join('notice','users.id','=','notice.user_id')
      ->select('notice.towho','notice.user_id as user','users.name','article.title as atitle','notice.title as ntitle','notice.content','notice.created_at','notice.company_id','notice.article_id')
      ->join('article','article.id','=','notice.article_id')
      ->where('notice.company_id','=',$company_id)
      ->whereNotIn('towho',['BtoC','toB'])
      ->orderBy('notice.created_at','desc')
      ->orderBy('notice.user_id')
      ->get();
      $results = array('notice' => $notice);
      return $results;
    }

    public function fortitleselect(Request $request)
    {
      $company_id = $request->ans1;
      $title = $request->ans2; //article_id
      if($title == 'all'){
        $notice = users::join('notice','users.id','=','notice.user_id')
        ->select('notice.towho','notice.user_id as user','users.name','article.title as atitle','notice.title as ntitle','notice.content','notice.created_at','notice.company_id','notice.article_id','article.company')
        ->join('article','article.id','=','notice.article_id')
        ->where('notice.company_id','=',$company_id)
        ->whereNotIn('towho',['BtoC','toB'])
        ->orderBy('notice.created_at','desc')
        ->get();
      }else{
        $notice = users::join('notice','users.id','=','notice.user_id')
        ->select('notice.towho','notice.user_id as user','users.name','article.title as atitle','notice.title as ntitle','notice.content','notice.created_at','notice.company_id','notice.article_id')
        ->join('article','article.id','=','notice.article_id')
        ->where('notice.company_id','=',$company_id)
        ->where('notice.article_id','=',$title)
        ->whereNotIn('towho',['BtoC','toB'])
        ->orderBy('notice.created_at','desc')
        ->orderBy('notice.user_id')
        ->get();
      }
      $results = array('notice' => $notice);
      return $results;
    }

    public function usernotice($id) //user_id
    {
      $notice = users::join('notice','users.id','=','notice.user_id')
      ->select('notice.towho','notice.user_id as user','users.name','article.title as atitle','notice.title as ntitle','notice.content','notice.created_at','notice.company_id','notice.article_id','article.company')
      ->join('article','article.id','=','notice.article_id')
      ->where('notice.user_id','=',$id)
      ->whereNotIn('towho',['BtoC','toB'])
      ->orderBy('notice.created_at','desc')
      ->get();

      $report = report::where('user_id','=',$id)->get();

      return view('usernotice',array('user_id' => $id,'notice' => $notice,'report' => $report));
    }

    public function company($id) //company_id
    {
      $user = Auth::user();
      if(isset($user)){
        $user_id = $user->id;
      }else{
        $user_id = null;
      }
      $now = $this->now;

      $article = article::where('user_id',$id)
      ->where('deadline','>=',$now)->get();
      $user = users::where('id',$id)->first();
      $followed = follow::where('company_id',$id)
      ->where('user_id',$user_id)->count();
      $numofapply = apply::where('company_id',$id)->count();
      $numofnotice = apply::where('company_id',$id)->where('notice',1)->count();
      if($numofapply==0){
        $reply = 0;
      }else{
        $reply = round(($numofnotice/$numofapply)*100,2);
      }
      return view('company',array('article' => $article,'user' => $user,'followed' => $followed,'reply' => $reply));
    }

  // file Storage and backup database
      public function showdatabase()
      {
        $sqlname = Session::get('backupsql');
        $contents = Storage::get('file.txt');
        Session::set('backupsql2', '55678.sql');

        return view('showdatabase',array('test' => $contents,'sql' => $sqlname,));
      }
      public function appendtofile(Request $request)
      {
        Storage::append('file.txt', $request->content);
        $contents = Storage::get('file.txt');

        $results = array('content' => $contents);
        return $results;
      }

    public function downloadsql()
    {

      // $sqlname = Session::get('backupsql2');
      $path = storage_path('app/backupsql.sql');
      // Session::flush();
      // $path = storage_path('app/546485645645654');
      return response()->download($path);
    }

    public function report(Request $request)
    {
      $now = $this->now;

      if(isset(Auth::user()->id)){
        $report = new report();
        $report->user_id = Auth::user()->id;
        $report->company_id = $request->company_id;
        $report->article_id = $request->article_id;
        $report->article_title = $request->article_title;
        $report->article_type = $request->article_type;
        $report->article_company = $request->article_company;
        $report->report_reason = $request->report_reason;
        $report->report_content = $request->report_content;
        $report->created_at = $now;
        $report->save();

        $userexist = 1;
      }else{
        $userexist = 0;
        $report = null;
      }

      $results = array('report' => $report,'userexist' => $userexist);
      return $results;
    }

    public function follow(Request $request)
    {
      $now = $this->now;

      $user = Auth::user();
      if(isset($user)){
        $user_id = $user->id;

        if($request->followed==0){
          $follow = new follow();
          $follow->user_id = $user_id;
          $follow->company_id = $request->company_id;
          $follow->created_at = $now;
          $follow->save();

          users::find($request->company_id)->increment('numoffollow', 1);
          $newfollowed = 1;
        }else {
          $follow = follow::where('company_id',$request->company_id)->delete();

          users::find($request->company_id)->decrement('numoffollow', 1);
          $newfollowed = 0;
        }

        $results = array('newfollowed' => $newfollowed);
        return $results;
      }
      $results = array('newfollowed' => 2);
      return $results;
    }

    public function showreport($id = null)
    {
      if($id == null){
        $report = users::orderBy('report.created_at','desc')
        ->join('report','users.id','=','report.user_id')
        ->get();
      }else{
        $report = users::orderBy('report.created_at','desc')
        ->join('report','users.id','=','report.user_id')
        ->where('report.article_id',$id)
        ->get();
      }
      return view('showreport',array('report' => $report));
    }

    public function showfollows(Request $request)
    {
      $user = Auth::user();
      $user_id = $user->id;

      $follow = follow::where('user_id','=',$user_id)->pluck('company_id');
      $company = users::whereIn('id',$follow)->get();

      $oneweek = Carbon::today('Asia/Taipei')->subWeek();
      $article = article::whereIn('user_id',$follow)
      ->where('created_at','>=',$oneweek)->get();

      $results = array('article' => $article,'follow' => $follow,'company' => $company);
      return $results;
    }

    public function close()
    {
      return view('close');
    }

    public function application()
    {
      $now = $this->now;
      $oneday = Carbon::today('Asia/Taipei')->subday();
      $oneweek = Carbon::today('Asia/Taipei')->subWeek();
      $onemonth = Carbon::today('Asia/Taipei')->subMonth();

      $article = article::orderBy('created_at','desc')
      ->where('deadline','>=',$now)->get();
      $article_id = article::orderBy('created_at','desc')
      ->where('deadline','>=',$now)->pluck('id')->toArray();
      $count = article::where('id','!=',null)
      ->where('deadline','>=',$now)->count();

      $counttoday = article::where('id','!=',null) //Past 24hrs
      ->where('created_at','>=',$oneday)->count();
      $countweek = article::where('id','!=',null) //Past 7days
      ->where('created_at','>=',$oneweek)->count();
      $countmonth = article::where('id','!=',null) //Past 1month
      ->where('created_at','>=',$onemonth)->count();

      $reportnum = array();
      for ($i=0; $i <$count ; $i++) {
        $report = report::where('article_id',$article_id[$i])->count();
        $reportnum = array_add($reportnum,$i,$report);
      }

      return view('application', array('article' => $article, 'count' => $count, 'reportnum' => $reportnum,'counttoday' => $counttoday, 'countweek' => $countweek, 'countmonth' => $countmonth));
    }

    public function applisearch(Request $request)
    {
      $now = $this->now;

      $ans = $request->ans;
      $ans1 = $request->ans1;
      $ans2 = $request->ans2;

      $article = article::where('title','like','%'.$ans.'%')
      ->where('deadline','>=',$now)
      ->where('location','like','%'.$ans1.'%')
      ->where('type','like','%'.$ans2.'%')
      ->get();
      $count = count($article);

      $article_id = article::where('title','like','%'.$ans.'%')
      ->where('deadline','>=',$now)
      ->where('location','like','%'.$ans1.'%')
      ->where('type','like','%'.$ans2.'%')
      ->pluck('id')->toArray();
      $reportnum = array();
      for ($i=0; $i <$count ; $i++) {
        $report = report::where('article_id',$article_id[$i])->count();
        $reportnum = array_add($reportnum,$i,$report);
      }

      $results = array('article' => $article,'count' => $count,'reportnum' => $reportnum);
      return $results;
    }

    public function applisearch2(Request $request)
    {
      $now = $this->now;

      $ans = $request->ans;
      $ans1 = $request->ans1;
      $ans2 = $request->ans2;

      $article = article::where('company','like','%'.$ans.'%')
      ->where('deadline','>=',$now)
      ->where('location','like','%'.$ans1.'%')
      ->where('type','like','%'.$ans2.'%')
      ->get();
      $count = count($article);

      $article_id = article::where('company','like','%'.$ans.'%')
      ->where('deadline','>=',$now)
      ->where('location','like','%'.$ans1.'%')
      ->where('type','like','%'.$ans2.'%')
      ->pluck('id')->toArray();
      $reportnum = array();
      for ($i=0; $i <$count ; $i++) {
        $report = report::where('article_id',$article_id[$i])->count();
        $reportnum = array_add($reportnum,$i,$report);
      }

      $results = array('article' => $article,'count' => $count,'reportnum' => $reportnum);
      return $results;
    }

    public function top(Request $request)
    {
      $now = $this->now;

      $articleid = $request->ans;
      article::whereIn('id',$articleid)->update(['hot' => 1]);

      $article = article::orderBy('hot','desc')
      ->orderBy('created_at','desc')
      ->where('deadline','>=',$now)->get();
      $count = count($article);

      $article_id = article::orderBy('hot','desc')
      ->orderBy('created_at','desc')
      ->where('deadline','>=',$now)
      ->pluck('id')->toArray();
      $reportnum = array();
      for ($i=0; $i <$count ; $i++) {
        $report = report::where('article_id',$article_id[$i])->count();
        $reportnum = array_add($reportnum,$i,$report);
      }

      $results = array('article' => $article,'count' => $count,'reportnum' => $reportnum);
      return $results;
    }

    public function notop(Request $request)
    {
      $now = $this->now;

      $articleid = $request->ans;
      article::whereIn('id',$articleid)->update(['hot' => 0]);

      $article = article::orderBy('hot','asc')
      ->orderBy('created_at','desc')
      ->where('deadline','>=',$now)->get();
      $count = count($article);

      $article_id = article::orderBy('hot','asc')
      ->orderBy('created_at','desc')
      ->where('deadline','>=',$now)
      ->pluck('id')->toArray();
      $reportnum = array();
      for ($i=0; $i <$count ; $i++) {
        $report = report::where('article_id',$article_id[$i])->count();
        $reportnum = array_add($reportnum,$i,$report);
      }

      $results = array('article' => $article,'count' => $count,'reportnum' => $reportnum);
      return $results;
    }

    public function talks_c($aid,$uid) //employer talk to applyer ; uid -> applyer
    {
      $article = article::where('id',$aid)->first();
      $user = users::where('id',$uid)->first(); //company
      $notice = notice::where('article_id',$aid)
      ->where('user_id',$uid)
      ->where('company_id',$article->user_id)
      ->whereNotIn('towho',['BtoC','toB'])
      ->orderBy('created_at','desc')
      ->get();
      apply::where('article_id',$aid)->where('user_id',$uid)
      ->update(['notice' => 1]);
      $host = 'employer';
      return view('talks',array('aid' => $aid,'uid' => $uid,'article' => $article,'notice' => $notice,'user' => $user,'host' => $host));
    }

    public function talks_u($aid,$uid) //applyer talk to employer ; uid -> applyer
    {
      $article = article::where('id',$aid)->first();
      $user = users::where('id',$uid)->first(); //applyer
      $notice = notice::where('article_id',$aid)
      ->where('user_id',$uid)
      ->where('company_id',$article->user_id)
      ->whereNotIn('towho',['BtoC','toB'])
      ->orderBy('created_at','desc')
      ->get();
      $host = 'applyer';
      return view('talks',array('aid' => $aid,'uid' => $uid,'article' => $article,'notice' => $notice,'user' => $user,'host' => $host));
    }

    public function talks_toB($cid,$aid = null) //company talk to FUTURA
    {
      $article = article::where('id',$aid)->first();
      $uid = users::where('isAdmin',2)->value('id');
      $notice = notice::where('company_id',$cid)
      ->whereIn('towho',['BtoC','toB'])
      ->orderBy('created_at','desc')
      ->get();
      $host = 'BtoC';
      return view('talks',array('aid' => $aid,'cid' => $cid,'uid' => $uid,'article' => $article,'notice' => $notice,'host' => $host));
    }

    public function talks_BtoC($cid) //FUTURA talk to company
    {
      $article = article::where('user_id',$cid)->first();
      $uid = Auth::user()->id;
      $notice = notice::where('company_id',$cid)
      ->whereIn('towho',['BtoC','toB'])
      ->orderBy('created_at','desc')
      ->get();
      $host = 'toB';
      return view('talks',array('cid' => $cid,'uid' => $uid,'article' => $article,'notice' => $notice,'host' => $host));
    }

    public function addtalks(Request $request)
    {
      $now = $this->now;

      $notice = new notice($request->all());
      $notice->created_at = $now;
      $notice->save();
      $results = array('notice' => $notice);
      return $results;
    }

    public function mynotice()
    {
      $notice = users::join('notice','notice.company_id','=','users.id')
      ->whereIn('towho',['toB','BtoC'])
      ->latest('notice.created_at')
      ->get()->unique('company_id');

      return view('mynotice',array('notice' => $notice));
    }


    public function allintern()
    {
      $now = $this->now;

      $article = article::orderBy('hot','desc')
      ->orderBy('created_at','desc')
      ->where('deadline','>=',$now)->paginate(5);  //0915後

      $hotarticle = article::select('id','title','company', DB::raw('(numoflike*0.35+numofapply*0.65) as hot'))
      ->orderBy('hot','desc')->where('deadline','>=',$now)->take(5)->get(); //1007

      return view('allintern', array('articles' => $article,'hotarticle' => $hotarticle));
    }

    //0915後

    public function Btnforlocation2()
    {
      $now = $this->now;

      $article = order::orderBy('order.id')
      ->join('article','article.location','=','order.city')
      ->where('article.deadline','>=',$now)
      ->paginate(5);

      $article->setPath('location/allintern');

      return view('Page', array('articles' => $article));
    }

    public function ajaxpage()
    {
      $now = $this->now;

      $article = article::orderBy('hot','desc')
      ->orderBy('created_at','desc')
      ->where('deadline','>=',$now)->paginate(5);

      return view('Page', array('articles' => $article))->render();
    }

    //09222

    public function set()
    {
      return view('set');
    }

    public function usersboard()
    {
      $user = users::orderBy('isAdmin','desc')->get();
      return view('usersboard',array('user' => $user));
    }

    public function adminupdate(Request $request)
    {
      $user = users::find($request->user_id)
      ->update(['isAdmin' => $request->admin]);

      return redirect('usersboard')->with('msg','已修改 '.$request->username.' 的權限');
      // return redirect('usersboard',array('username' => $request->username));
    }


    //0929測試爬蟲 OK


    public function jacktest() //this one just a test
    {

      $crawler = Goutte::request('GET', 'https://www.1111.com.tw/zone/internships/');

      $this->job = $crawler->filter('.deline td:nth-child(2)')->each(function($node){
            return [
                'title' => $node->filter('.style2 a')->attr('title'),
                'url' => $node->filter('.style2 a')->attr('href'),
            ];
      });

      $this->company = $crawler->filter('.joblist_cont li .compname')->each(function($node){
            return [
                // 'title' => $node->filter('.compname a')->attr('title'),
                // 'url' => $node->filter('.compname a')->attr('href'),
            ];
      });

      return view('jacktest',array('job' => $this->job,'company' => $this->company));
    }

    public function fullsearch()
    {
      $crawler104 = Goutte::request('GET', 'https://www.104.com.tw/area/intern/search.cfm' );
      $splitName = explode('，', $crawler104->filter('.joblist_bar .right')->text(), 2);
      $this->e04 = $splitName[0];

      $crawler1111 = Goutte::request('GET', 'https://www.1111.com.tw/zone/internships/' );
      $this->e111 = $crawler1111->filter('#rec')->text();

      $now = $this->now;
      $count = article::where('deadline','>=',$now)->count();

      return view('Fullsearch',array('count104' => $this->e04,'count1111' => $this->e111,'count' => $count));
    }

    public function searchAll(Request $request)
    {
      //job104
      $url104 = 'https://www.104.com.tw/area/intern/search.cfm?keyword='.$request->key;
      $crawler104 = Goutte::request('GET', $url104 );

      $this->job104 = $crawler104->filter('.joblist_cont li .jobname')->each(function($node){ //Get job's name & href
            return [
                'title' => $node->filter('.jobname a')->attr('title'),
                'url' => $node->filter('.jobname a')->attr('href'),
            ];
      });

      $this->company104 = $crawler104->filter('.joblist_cont li .compname')->each(function($node){ //Get company's name
            return [
                'title' => $node->filter('.compname a')->attr('title'),
            ];
      });

      $this->loca104 = $crawler104->filter('.joblist_cont li .area')->each(function($node){ //Get area
            return [
                'loca' => $node->filter('.area')->text(),
            ];
      });

      //job1111
      $url1111 = 'https://www.1111.com.tw/zone/internships/?keys='.$request->key;
      $crawler1111 = Goutte::request('GET', $url1111 );

      $this->job1111 = $crawler1111->filter('.deline td:nth-child(2)')->each(function($node){ //Get job's name & href and company's name
        $splitName = explode('徵', $node->filter('.style2 a')->attr('title'), 2);
            return [
              'title' => $splitName[1],
              'company' => $splitName[0],
              'url' => $node->filter('.style2 a')->attr('href'),
            ];
      });

      $this->loca1111 = $crawler1111->filter('.deline td:nth-child(4)')->each(function($node){ //Get area
            return [
              'loca' => $node->filter('.list_black')->text(),

            ];
      });

      //FUTURA local job
      $now = $this->now;
      $article = article::where('title','like','%'.$request->key.'%')
      ->where('deadline','>=',$now)
      ->get();

      $results = array(
        'job104' => $this->job104,'company104' => $this->company104,'url104' =>$url104,'loca104' =>$this->loca104,
        'job1111' => $this->job1111,'loca1111' => $this->loca1111,'url1111' => $url1111,
        'article' => $article
      );
      return $results;
    }

    //1007

    public function analyze()
    {
      $hotapply = apply::select('article_type', DB::raw('COUNT(article_type) as counthottype'))
      ->groupBy('article_type')
      ->orderBy('counthottype','desc')->take(5)->get();

      $oneweek = Carbon::today('Asia/Taipei')->subWeek();
      $latelyhotapply = apply::select('article_type','created_at', DB::raw('COUNT(article_type) as latelycounthottype'))
      ->groupBy('article_type')
      ->where('created_at','>',$oneweek)
      ->orderBy('latelycounthottype','desc')->take(5)->get();

      $hotcollect = collection::select('article_type', DB::raw('COUNT(article_type) as counthottype'))
      ->groupBy('article_type')
      ->orderBy('counthottype','desc')->take(5)->get();

      $hotcompany = users::orderBy('numoffollow','desc')->take(5)->get();

      $article_at = article::select('location', DB::raw('COUNT(location) as countcity'))
      ->groupBy('location')
      ->orderBy('countcity','desc')->take(5)->get();

      return view('analyze',array('hotapply' => $hotapply,'latelyhotapply' => $latelyhotapply,'hotcollect' => $hotcollect,'hotcompany' => $hotcompany,'article_at' => $article_at));
    }


}
