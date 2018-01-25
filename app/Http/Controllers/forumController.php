<?php

namespace App\Http\Controllers;

use Carbon\carbon;
use App\Model2\article;
use App\Model2\collection;
use App\Model2\apply;
use App\Model2\users;
use App\Model2\order;
use App\Model2\notice;
use App\Model2\test;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Eventviva\ImageResize;
use Session;
use Illuminate\Support\Facades\Redirect;

use Goutte\Client;
use Goutte;
use Storage;

class forumController extends Controller
{
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
      $yahoo = Goutte::request('GET', 'https://tw.yahoo.com/' );
      $yahoo_hot = $yahoo->filter('td ul li a')->each(function($node){
            return [
                'hotword' => $node->filter('')->text(),
                'url' => $node->filter('')->attr('href'),
            ];
      });

      $test = test::orderBy('id','desc')->get();
      // $image = $test->each(function($name){
      //       return [
      //         'img1' => Storage::disk('test')->get($name->title.'.jpg'),
      //         'video' => Storage::disk('video')->get($name->title.'.mp4'),
      //       ];
      // });

      // $test = base64_decode($test2);

    return view('forum',array('yahoo' => $yahoo_hot,'test' => $test/*,'image' => $image*/));
    }

    public function upload(Request $request)
    {
      $time = Carbon::now();
      $timeStamp = $time->timestamp;

      $test = new test();
      if($request->hasFile('img1')){
        $file = $request->file('img1');
        $path = $timeStamp.$file->getClientOriginalName();
        $size = getimagesize($file);  //
        $width = $size[0];
        $height = $size[1];
        if($width > 340 && $height > 170){
          $resize = new ImageResize($request->img1);
          $file = $resize->resize(340,170);
          $file->save('uploads/'.$timeStamp.$path);
        }else{
          $file->move('uploads', $timeStamp.$path);
        }                          //

        $test->img1 = $timeStamp.$path;
      }

      if($request->hasFile('video1')){
        $file = $request->file('video1');
        $path = $file->getClientOriginalName();
        $file->move('uploads', $path);
        $test->video = $path;
      }
      $test->title = $request->title;
      $test->save();
      return redirect('/forum');
    }

    //
    public function test1()
    {
      return view('pratice');
    }
}
