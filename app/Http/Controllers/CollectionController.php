<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model2\collection;
use App\Model2\article;
use Carbon\carbon;
use Auth;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $limit = $request->limit?: 10;

      $collection = collection::paginate($limit);

      return response()->json($collection, 200);
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

      $collecte = new collection($request->all());
      $collecte->company_id = $article->user_id;
      $collecte->article_title = $article->title;
      $collecte->article_type = $article->type;
      $collecte->article_company = $article->company;
      $collecte->article_location = $article->location;
      $collecte->created_at = $now;
      $collecte->save();

      article::where('id',$request->article_id)->increment('numoflike', 1);

      return response()->json([
              'message' => 'collecte Created Succesfully',
              'data' => $collecte
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
      $collect = collection::find($id);

      if(!$collect){
          return response()->json([
              'error' => [
                  'message' => 'collect does not exist'
              ]
          ], 404);
      }
      return response()->json([
        'data' => collection::where('id',$id)->first()
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
      $article_id = collection::where('id',$id)->value('article_id');
      article::where('id',$article_id)->decrement('numoflike', 1);
      $collect = collection::destroy($id);
      if(!$collect){
        return response()->json([
            'error' => [
                'message' => 'Collection does not exist'
            ]
        ], 404);
      }
      return response()->json([
              'message' => 'Collection Deleted Succesfully'
      ]);
    }
}
