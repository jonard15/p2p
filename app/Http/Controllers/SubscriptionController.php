<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class SubscriptionController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions =  DB::table('subscriptions')
        ->leftjoin('subscribers', 'subscribers.account_no', '=', 'subscriptions.account_no')
        ->leftjoin('plans', 'plans.code', '=', 'subscriptions.plan_code')
        ->whereNull('subscriptions.deleted_at')
        ->orderBy('subscriptions.id', 'DESC')
        ->get([
            'subscribers.application_type',
            'subscribers.name as subscriber_name' ,
            'plans.name as plan_name' ,
            'plans.amount' ,
            'subscriptions.subscription_date' 
        ]);
  
        return $subscriptions;
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
        $subscriptions = new Subscription();
        columnSetter($subscriptions, $request);
        $subscriptions->code = generatePlanCode();
        return $subscriptions->save();
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
        $subscriptions = Subscription::find($id);
        $subscriptions->update($req->all());
        return $subscriptions;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriptions = Subscription::find($id);
        $subscriptions->delete();
        return $subscriptions;
    }
   
}
