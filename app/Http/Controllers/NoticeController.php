<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model2\notice;
use Carbon\carbon;
use Auth;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $limit = $request->limit?: 10;

      $notice = notice::paginate($limit);

      return response()->json($notice, 200);
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

      if(!$request->user_id||!$request->company_id||!$request->towho||!$request->content){
        return response()->json([
            'error' => [
                'message' => 'Please Provide : user_id&company_id&towho&content'
            ]
        ], 422);
      }

      $notice = new notice($request->all());
      $notice->created_at = $now;
      $notice->save();

      return response()->json([
              'message' => 'Notice Created Succesfully',
              'data' => $notice
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
      $notice = notice::find($id);

      if(!$notice){
          return response()->json([
              'error' => [
                  'message' => 'Notice does not exist'
              ]
          ], 404);
      }
      return response()->json([
        'data' => notice::where('id',$id)->first()
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
      $notice = notice::destroy($id);
      if(!$notice){
        return response()->json([
            'error' => [
                'message' => 'Notice does not exist'
            ]
        ], 404);
      }
      return response()->json([
              'message' => 'Notice Deleted Succesfully'
      ]);
    }
}
