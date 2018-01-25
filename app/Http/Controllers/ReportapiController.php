<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model2\report;
use App\Model2\article;
use Carbon\carbon;
use Auth;

class ReportapiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $limit = $request->limit?: 10;

      $report = report::paginate($limit);

      return response()->json($report, 200);
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

      if(!$request->user_id||!$request->article_id||!$request->report_reason||!$request->report_content){
        return response()->json([
            'error' => [
                'message' => 'Please Provide id -> user&article, reason&content by report'
            ]
        ], 422);
      }

      $article = article::where('id',$request->article_id)->first();

      $report = new report($request->all());
      $report->company_id = $article->user_id;
      $report->article_title = $article->title;
      $report->article_type = $article->type;
      $report->article_company = $article->company;
      $report->created_at = $now;
      $report->save();

      return response()->json([
              'message' => 'Report Created Succesfully',
              'data' => $report
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
      $report = report::find($id);

      if(!$report){
          return response()->json([
              'error' => [
                  'message' => 'Report does not exist'
              ]
          ], 404);
      }
      return response()->json([
        'data' => report::where('id',$id)->first()
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
      $report = report::destroy($id);
      if(!$report){
        return response()->json([
            'error' => [
                'message' => 'Report does not exist'
            ]
        ], 404);
      }
      return response()->json([
              'message' => 'Report Deleted Succesfully'
      ]);
    }
}
