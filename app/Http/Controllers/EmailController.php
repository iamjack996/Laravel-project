<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
  public function index()
  {
    return view('email');
  }
  public function notify(Request $request){

      //List ID from .env
      $listId = env('MAILCHIMP_LIST_ID');

      //Mailchimp instantiation with Key
      $mailchimp = new \Mailchimp(env('MAILCHIMP_KEY'));

      //Create a Campaign $mailchimp->campaigns->create($type, $options, $content)
      // $campaign = $mailchimp->campaigns->create('regular', [
      //     'list_id' => $listId,
      //     'subject' => 'Test part 2',
      //     'from_email' => $request->email,
      //     'from_name' => $request->name,
      //     'to_name' => 'Futura Subscriber'
      //
      // ], [
      //     'html' => $request->input('content'),
      //     'text' => strip_tags($request->input('content'))
      // ]);
      //
      // //Send campaign
      // $mailchimp->campaigns->send($campaign['id']);

      $mailchimp
            ->lists
            ->subscribe(
                $listId,
                ['email' => $request->input('email')]
            );

      return response()->json(['status' => 'Success']);
  }
  public function campaignindex()
  {
    return view('createcampaign');
  }
  public function campaign(Request $request)
  {
    //List ID from .env
    $listId = env('MAILCHIMP_LIST_ID');

    //Mailchimp instantiation with Key
    $mailchimp = new \Mailchimp(env('MAILCHIMP_KEY'));

    //Create a Campaign $mailchimp->campaigns->create($type, $options, $content)
    $campaign = $mailchimp->campaigns->create('regular', [
        'list_id' => $listId,
        'subject' => $request->subject,
        'from_email' => $request->email,
        'from_name' => $request->name,
        'to_name' => 'Futura Subscriber'

    ], [
        'html' => $request->input('content'),
        'text' => strip_tags($request->input('content'))
    ]);

    //Send campaign
    $mailchimp->campaigns->send($campaign['id']);

    return response()->json(['status' => 'Success']);
  }

}
