<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return Inertia::render('MessangerChat')->with('GymOwnerPayments', $GymOwnerPayments);;
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }

    public function create_show(User $user){
        //dd($user);
        //dd(Request::user()->id);
        $Thread = Thread::whereHas('User', function ($query) use ($user) {
            $query->where('users.id', Request::user()->id);
        })
        ->whereHas('User', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })
        ->get();    
         
        //dd($Thread);
        if($Thread->isEmpty()){
            $Thread=Thread::create();
            $Thread->User()->attach($user);
            $Thread->User()->attach(Request::user()->id);
        }else{
           //dd($Thread); 

        }
       // if
    }
}
