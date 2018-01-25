<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model2\apply;
use App\Model2\article;
use Carbon\carbon;
use Auth;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $limit = $request->limit?: 10;

      $apply = apply::paginate($limit);

      return response()->json($apply, 200);
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

      if(!$request->user_id||!$request->article_id){
        return response()->json([
            'error' => [
                'message' => 'Please Provide id -> user&article'
            ]
        ], 422);
      }
      $article = article::where('id',$request->article_id)->first();

      $apply = new apply($request->all());
      $apply->company_id = $article->user_id;
      $apply->article_title = $article->title;
      $apply->article_type = $article->type;
      $apply->article_company = $article->company;
      $apply->article_location = $article->location;
      $apply->created_at = $now;
      $apply->save();

      article::where('id',$request->article_id)->increment('numofapply', 1);

      return response()->json([
              'message' => 'Apply Created Succesfully',
              'data' => $apply
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
      $apply = apply::find($id);

      if(!$apply){
          return response()->json([
              'error' => [
                  'message' => 'Apply does not exist'
              ]
          ], 404);
      }
      return response()->json([
        'data' => apply::where('id',$id)->first()
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $article_id = apply::where('id',$id)->value('article_id');
      article::where('id',$article_id)->decrement('numofapply', 1);
      $apply = apply::destroy($id);
      if(!$apply){
        return response()->json([
            'error' => [
                'message' => 'Apply does not exist'
            ]
        ], 404);
      }
      return response()->json([
              'message' => 'Apply Deleted Succesfully'
      ]);
    }
}
