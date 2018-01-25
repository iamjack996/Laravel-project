<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model2\follow;
use App\Model2\users;
use Carbon\carbon;
use Auth;

class FollowapiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $limit = $request->limit?: 10;

      $follow = follow::paginate($limit);

      return response()->json($follow, 200);
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

      if(!$request->user_id||!$request->company_id){
        return response()->json([
            'error' => [
                'message' => 'Please Provide id -> user&company'
            ]
        ], 422);
      }
      $follow = follow::create($request->all());
      $follow->created_at = $now;
      $follow->save();

      users::where('id',$request->company_id)->increment('numoffollow', 1);

      return response()->json([
        'message' => 'Follow Created Succesfully',
        'data' => $follow
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
      $follow = follow::find($id);

      if(!$follow){
          return response()->json([
              'error' => [
                  'message' => 'Follow does not exist'
              ]
          ], 404);
      }
      return response()->json([
        'data' => follow::where('id',$id)->first()
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
      $company_id = follow::where('id',$id)->value('company_id');
      users::where('id',$company_id)->decrement('numoffollow', 1);
      $follow = follow::destroy($id);
      if(!$follow){
        return response()->json([
            'error' => [
                'message' => 'Follow does not exist'
            ]
        ], 404);
      }
      return response()->json([
              'message' => 'Follow Deleted Succesfully'
      ]);
    }
}
