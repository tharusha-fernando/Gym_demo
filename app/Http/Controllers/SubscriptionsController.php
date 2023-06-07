<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
use App\Http\Requests\StoreSubscriptionsRequest;
use App\Http\Requests\UpdateSubscriptionsRequest;
use Inertia\Inertia;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions=Subscriptions::all();
        return Inertia::render('Admin/ViewSubscriptions')->with('Subscriptions',$subscriptions);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/AddSubscription');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionsRequest $request)
    {
        $data=$request->validated();
        $data['price']=strval(($data['price']*100));
        //dd($data);
        Subscriptions::create($data);
        return redirect()->route('subscription-packages.index')->with('message','New Subscription Package Has Been Addedd');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscriptions $subscriptions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($sub)//Subscriptions $subscriptions
    {
        //dd($sub);
        $subscriptions=Subscriptions::find($sub);
        return Inertia::render('Admin/EditSubscription')->with('Subscription',$subscriptions);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionsRequest $request, $subscriptions)//Subscriptions $subscriptions
    {
        //dd($request);
        $data=$request->validated();
        //dd($subscriptions);
        $Subs=Subscriptions::find($subscriptions);
        $Subs->update($data);

        return redirect()->route('subscription-packages.index')->with('message', "Subscription has been updated successfully");
  
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriptions $subscriptions)
    {
        //
    }
}
