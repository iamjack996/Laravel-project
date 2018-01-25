<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Model2\order;


class apiController extends Controller
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
          $order = order::where('city','like','%'.$search.'%')->paginate($limit);

          $order->appends(array(
              'search' => $search,
              'limit' => $limit
          ));
        }else{
          $order = order::select('id', 'city')->paginate($limit);

          $order->appends(array(
              'limit' => $limit
          ));
        }
        return response()->json($order, 200);
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
      if(!($request->city)){
        return response()->json([
            'error' => [
                'message' => 'Please Provide city'
            ]
        ], 422);
      }

      $city = order::create($request->all());

      return response()->json([
        'message' => 'CITY Created Succesfully',
        'data' => $city
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
      $order = order::find($id);

      if(!$order){
          return response()->json([
              'error' => [
                  'message' => 'data does not exist'
              ]
          ], 404);
      }
      return response()->json([
        'data' => order::where('id',$id)->first()
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
      $order = order::find($id);

      if(!$order){
          return response()->json([
              'error' => [
                  'message' => 'data does not exist'
              ]
          ], 404);
      }

      if(!isset($request->city)){
          return response()->json([
              'error' => [
                  'message' => 'Please Provide city'
              ]
          ], 422);
      }

      $order->city = $request->city;
      $order->save();

      return response()->json([
              'message' => 'order Updated Succesfully'
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
        order::destroy($id);
        return response()->json([
                'message' => 'order deleted Succesfully'
        ]);
    }
}
