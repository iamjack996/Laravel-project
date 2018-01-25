<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Model2\Problem;
use Illuminate\Http\Request;
use App\Model2\article;

Route::post('/notify', 'EmailController@notify');


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/json',  ['as' =>  'json',   'uses' => 'testController@getjson']);
// Route::post('/test',  ['as' =>  'test',   'uses' => 'testController@postdata']);
// Route::get('/test' ,['test','uses' => 'testController@index']);


// Route::get('/allarticle', ['as' => 'allarticle', 'uses' => 'internController@index']);

Route::get('/addarticle/{id}', ['as' => 'addarticle', 'uses' => 'internController@addarticle']);
Route::post('/addarticle', ['as' => 'addarticle', 'uses' => 'internController@addarticlepost']);

// Route::get('/updatearticle', ['as' => 'updatearticle', 'uses' => 'internController@updatearticle']);
Route::get('/updatearticle/{id}', ['as' => 'updatearticle', 'uses' => 'internController@updatearticle']);
Route::post('/updatearticle/{id}', ['as' => 'updatearticle', 'uses' => 'internController@updatearticlepost']);
Route::post('/deletearticle/{id}', ['as' => 'deletearticle', 'uses' => 'internController@deletearticlepost']);

Route::get('/Btnforlocation', ['as' => 'Btnforlocation', 'uses' => 'internController@Btnforlocation']);
Route::get('/Btnfordeadline', ['as' => 'Btnfordeadline', 'uses' => 'internController@Btnfordeadline']);
Route::get('/Btnforlasttime', ['as' => 'Btnforlasttime', 'uses' => 'internController@Btnforlasttime']);
Route::get('/forexpire', ['as' => 'forexpire', 'uses' => 'internController@forexpire']);

Route::get('/forcity', ['as' => 'forcity', 'uses' => 'internController@forcity']);
Route::get('/search', ['as' => 'search', 'uses' => 'internController@search']);
Route::get('/cityshow', ['as' => 'cityshow', 'uses' => 'internController@searchcityshow']);
Route::get('/typeshow', ['as' => 'typeshow', 'uses' => 'internController@searchtypeshow']);

Route::get('/allintern', ['as' => 'allintern', 'uses' => 'internController@allintern']);
Route::get('/detail/{id}', ['as' => 'detail', 'uses' => 'internController@detail']);

Route::post('/addtocollection', ['as' => 'addtocollection', 'uses' => 'internController@addtocollection']);
Route::post('/notify', 'EmailController@notify');
Route::get('/email', 'EmailController@index');
Route::get('/createcampaign', 'EmailController@campaignindex');
Route::post('/campaign', 'EmailController@campaign');

Route::get('/searchselect', ['as' => 'searchselect', 'uses' => 'internController@searchselect']);
Route::get('/searchselect2', ['as' => 'searchselect2', 'uses' => 'internController@searchselect2']);
Route::get('/searchselect3', ['as' => 'searchselect3', 'uses' => 'internController@searchselect3']);
Route::get('/search2', ['as' => 'search2', 'uses' => 'internController@search2']);

Route::get('/usercenter/{id}', ['as' => 'usercenter', 'uses' => 'internController@usercenter']);
Route::post('/applythis', ['as' => 'apply', 'uses' => 'internController@applythis']);
Route::get('/applyrecord/{id}', ['as' => 'applyrecord', 'uses' => 'internController@applyrecord']);
Route::post('/deleteapply', ['as' => 'deleteapply', 'uses' => 'internController@deleteapply']);
Route::post('/deletecollection', ['as' => 'deletecollection', 'uses' => 'internController@deletecollection']);
Route::post('/destroyarticle', ['as' => 'destroyarticle', 'uses' => 'internController@destroyarticle']);
Route::get('/collecterecord/{id}', ['as' => 'collecterecord', 'uses' => 'internController@collecterecord']);

//

Route::get('/internapplicants/{id}', ['as' => 'internapplicants', 'uses' => 'internController@internapplicants']);
Route::post('/noticeapplicants/{id}', ['as' => 'noticeapplicants', 'uses' => 'internController@noticeapplicants']);
Route::post('/notice/{id}', ['as' => 'notice', 'uses' => 'internController@notice']);



Route::get('/foruser', ['as' => 'foruser', 'uses' => 'internController@foruser']);
Route::get('/fortitleselect', ['as' => 'fortitleselect', 'uses' => 'internController@fortitleselect']);

Route::get('/usernotice/{id}', ['as' => 'usernotice', 'uses' => 'internController@usernotice']);
Route::get('/company/{id}', ['as' => 'company', 'uses' => 'internController@company']);

Route::get('/searchmap', ['as' => 'searchmap', 'uses' => 'internController@searchmap']); //test

Route::get('/showdatabase', ['as' => 'showdatabase', 'uses' => 'internController@showdatabase']);
Route::get('/appendtofile', ['as' => 'appendtofile', 'uses' => 'internController@appendtofile']);
Route::get('/downloadsql', ['as' => 'downloadsql', 'uses' => 'internController@downloadsql']);

Route::post('/report', ['as' => 'report', 'uses' => 'internController@report']);
Route::post('/follow', ['as' => 'follow', 'uses' => 'internController@follow']);
Route::get('/showreport/{id?}', ['as' => 'showreport', 'uses' => 'internController@showreport']);
Route::get('/showfollows', ['as' => 'showfollows', 'uses' => 'internController@showfollows']);
Route::get('/close', ['as' => 'close', 'uses' => 'internController@close']);


Route::get('/applisearch', ['as' => 'applisearch', 'uses' => 'internController@applisearch']);
Route::get('/applisearch2', ['as' => 'applisearch2', 'uses' => 'internController@applisearch2']);
Route::post('/top', ['as' => 'top', 'uses' => 'internController@top']);
Route::post('/notop', ['as' => 'notop', 'uses' => 'internController@notop']);
Route::post('/notices', ['as' => 'notices', 'uses' => 'internController@notices']);
Route::post('/noticespost', ['as' => 'noticespost', 'uses' => 'internController@noticespost']);

Route::get('/internapplicants/{aid}/talks/{uid}', ['as' => 'talks', 'uses' => 'internController@talks_c']);
Route::post('/addtalks', ['as' => 'addtalks', 'uses' => 'internController@addtalks']);
Route::get('/applyrecord/{aid}/talks/{uid}', ['as' => 'talks', 'uses' => 'internController@talks_u']);
Route::get('/companynotice/{cid}/talks/{aid?}', ['as' => 'talks', 'uses' => 'internController@talks_toB']);
Route::get('/mynotice/{cid}', ['as' => 'talks', 'uses' => 'internController@talks_BtoC']);


// 0915後 api
Route::resource('api', 'apiController'); //test api
Route::get('/Btnforlocation2', ['as' => 'Btnforlocation2', 'uses' => 'internController@Btnforlocation2']);
Route::get('/ajaxpage', ['as' => 'ajaxpage', 'uses' => 'internController@ajaxpage']);

//Restful Api Route
Route::resource('article', 'ArticleController');
Route::resource('user', 'UserController');
Route::resource('apply', 'ApplyController');
Route::resource('notice', 'NoticeController');
Route::resource('collection', 'CollectionController');
Route::resource('followapi', 'FollowapiController');
Route::resource('reportapi', 'ReportapiController');

// 0922
Route::get('/set', ['as' => 'set', 'uses' => 'internController@set']);

// 0929 爬蟲
Route::get('/jacktest', ['as' => 'jacktest', 'uses' => 'internController@jacktest']);
Route::get('/fullsearch', ['as' => 'fullsearch', 'uses' => 'internController@fullsearch']);
Route::get('/searchall', ['as' => 'searchAll', 'uses' => 'internController@searchAll']);


// Route::get('/allarticle', 'internController@index')->middleware('admin'); //*

Route::group(['middleware' => ['admin']], function () {
    Route::get('/allarticle', 'internController@index');
    Route::get('/analyze', ['as' => 'analyze', 'uses' => 'internController@analyze']);
    Route::get('/usersboard', ['as' => 'usersboard', 'uses' => 'internController@usersboard']);
    Route::post('/adminupdate', ['as' => 'adminupdate', 'uses' => 'internController@adminupdate']);
    Route::get('/mynotice', ['as' => 'mynotice', 'uses' => 'internController@mynotice']);
    Route::get('/application', ['as' => 'application', 'uses' => 'internController@application']);
});

Route::group(['middleware' => ['companyMiddleware','admin']], function () {
    Route::get('/companycenter/{id}', ['as' => 'companycenter', 'uses' => 'internController@companycenter']);
    Route::get('/applyerrecord/{id}', ['as' => 'applyerrecord', 'uses' => 'internController@applyerrecord']);
    Route::get('/companynotice/{id}', ['as' => 'companynotice', 'uses' => 'internController@companynotice']);
    Route::post('/companynoticeget/{id}', ['as' => 'companynoticeget', 'uses' => 'internController@companynoticeget']);
    Route::post('/companynoticepost/{id}', ['as' => 'companynoticepost', 'uses' => 'internController@companynoticepost']);
});

Route::get('test2', function () {
    return App\Model2\article::paginate();
});




Route::get('/test1', ['as' => 'test1', 'uses' => 'forumController@test1']);
Route::get('/forum', ['as' => 'forum', 'uses' => 'forumController@index']);
Route::post('/upload', ['as' => 'upload', 'uses' => 'forumController@upload']);


// Route::post('/test',function(){
//   if(Request::ajax()){
//     return Response::json($request->all());
//     // $pro = new Problem($request->all());
//     // $pro->save();
//     // return $pro;
//   }
// });

Auth::routes();

Route::get('/home', 'HomeController@index');
