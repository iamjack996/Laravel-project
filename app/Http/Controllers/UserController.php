<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model2\users;
use Carbon\carbon;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $limit = $request->limit?: 10;
      $search = $request->search;
      if(isset($search)){
        $user = users::where('name','like','%'.$search.'%')->paginate($limit);
      }else{
        $user = users::paginate($limit);
      }
      return response()->json($user, 200);
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

      if(!$request->name||!$request->email||!$request->password){
        return response()->json([
            'error' => [
                'message' => 'Please Provide : name&email&password'
            ]
        ], 422);
      }
      $user = users::create($request->all());
      $user->created_at = $now;
      $user->save();

      return response()->json([
              'message' => 'User Created Succesfully',
              'data' => $user
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
      $user = users::find($id);

      if(!$user){
          return response()->json([
              'error' => [
                  'message' => 'User does not exist'
              ]
          ], 404);
      }
      return response()->json([
        'data' => users::where('id',$id)->first()
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

      $user = users::find($id);

      if(!$user){
        return response()->json([
            'error' => [
                'message' => 'User does not exist'
            ]
        ], 404);
      }
      if(!$request->name||!$request->email||!$request->password){
          return response()->json([
              'error' => [
                  'message' => 'Please Provide : name&email&password'
              ]
          ], 422);
      }
      users::where('id',$id)->update($request->all());
      $user->updated_at = $now;
      $user->save();

      return response()->json([
              'message' => 'User Updated Succesfully'
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
      $user = users::destroy($id);
      if(!$user){
        return response()->json([
            'error' => [
                'message' => 'User does not exist'
            ]
        ], 404);
      }
      return response()->json([
              'message' => 'User Deleted Succesfully'
      ]);
    }
}
