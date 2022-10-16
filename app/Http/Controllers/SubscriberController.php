<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Subscribers,Subscriptions,Plans};
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class SubscriberController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriber =  DB::table('subscribers')
        ->whereNull('subscribers.deleted_at')
        ->orderBy('id', 'DESC')
        ->get();
  
        return $subscriber;
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
        $subscriber = new Subscribers();
        columnSetter($subscriber, $request);
        $subscriber->account_no = generateAccountNo();
        $plans = Plans::whereIn('id',[$request->plan_id])->first();
        $subscription = new Subscriptions();
        columnSetter($subscription, $request);
        $subscription->account_no =  $subscriber->account_no;
        $subscription->plan_code =   $plans->code;
        $subscription->subscription_date =now();
        $subscription->status ='Active';
        $subscriber->save();
      
        return   $subscription->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $req, $id)
    {
        $subscriber = Subscribers::find($id);
        $subscriber->update($req->all());
        return $subscriber;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriber = Subscribers::find($id);
        $subscriber->delete();
        return $subscriber;
    }
}
