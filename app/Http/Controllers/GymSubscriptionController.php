<?php

namespace App\Http\Controllers;

use App\Models\GymSubscription;
use App\Http\Requests\StoreGymSubscriptionRequest;
use App\Http\Requests\UpdateGymSubscriptionRequest;
use Inertia\Inertia;

class GymSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gymsubscriptions=GymSubscription::where('gym_owner_id',request()->user()->id)->paginate();
        return Inertia::render('GymOwner/ViewGymSubscriptions')->with('GymSubscriptions',$gymsubscriptions);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('GymOwner/AddGymSubscription');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGymSubscriptionRequest $request)
    {
        //dd("asasasasa");
        $data=$request->validated();
        $data['price']=strval(($data['price']*100));
        //dd($data);
        GymSubscription::create($data);
        return redirect()->route('gym-subscriptions.index')->with('message','New Subscription Package Has Been Addedd');
       
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GymSubscription $gymSubscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymSubscription $gymSubscription)
    {
        //$subscriptions=Subscriptions::find($sub);
        return Inertia::render('GymOwner/EditGymSubscription')->with('gymSubscription',$gymSubscription);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGymSubscriptionRequest $request, GymSubscription $gymSubscription)
    {
        $data=$request->validated();
        //dd($data);
        $gymSubscription->update($data);
        return redirect()->route('gym-subscriptions.index')->with('message', "Subscription has been updated successfully");
  
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymSubscription $gymSubscription)
    {
        //
    }
}
