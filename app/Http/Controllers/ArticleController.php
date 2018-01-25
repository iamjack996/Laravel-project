<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model2\article;
use Carbon\carbon;
use Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $search = $request->search;
      $limit = $request->limit?$request->limit:5;

      if($search)
      {
        $article = article::where('title','like','%'.$search.'%')
        ->orderBy('id','desc')->paginate($limit);
      }else {
        $article = article::orderBy('id','desc')->paginate($limit);
      }

      return response()->json([
         'data' => $article
       ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $now = Carbon::now();
      $now->timezone = new \DateTimeZone('Asia/Taipei');
      $now = $now->format('Y-m-d\TH:i:s');

      if(!$request->user_id||!$request->company_id||!$request->title||!$request->content||!$request->deadline||!$request->detail||!$request->location||
    !$request->address||!$request->numofpeople||!$request->type||!$request->howlong||!$request->skill||!$request->salt){ //驗證
          return response()->json([
              'error' => [
                  'message' => 'Please Provide :title|content|deadline|detail|location|address|numofpeople|type|howlong|skill|salt'
              ]
          ], 422);
      }

      $article = article::create($request->all());
      $article->created_at = $now;
      $article->save();
      return response()->json([
              'message' => 'Article Created Succesfully',
              'data' => $article
      ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = article::find($id);

        if(!$article){
          return response()->json([
              'error' => [
                  'message' => 'Data does not exist'
              ]
          ], 404);
        }
        return response()->json([
          'data' => article::where('id',$id)->first()
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $now = Carbon::now();
      $now->timezone = new \DateTimeZone('Asia/Taipei');
      $now = $now->format('Y-m-d\TH:i:s');

      $article = article::find($id);

      if(!$article){
        return response()->json([
            'error' => [
                'message' => 'Article does not exist'
            ]
        ], 404);
      }

      if(!$request->title||!$request->content||!$request->deadline||!$request->detail||!$request->location||
    !$request->address||!$request->numofpeople||!$request->type||!$request->howlong||!$request->skill||!$request->salt){
          return response()->json([
              'error' => [
                  'message' => 'Please Provide :title|content|deadline|detail|location|address|numofpeople|type|howlong|skill|salt'
              ]
          ], 422);
      }

      article::where('id',$id)->update($request->all());
      $article->updated_at = $now;
      $article->save();

      return response()->json([
              'message' => 'Article Updated Succesfully'
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $article = article::destroy($id);
      if(!$article){
        return response()->json([
            'error' => [
                'message' => 'Article does not exist'
            ]
        ], 404);
      }
      return response()->json([
              'message' => 'Article Deleted Succesfully'
      ]);
    }
}
