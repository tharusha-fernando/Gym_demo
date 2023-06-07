<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Http\Requests\StoreThreadRequest;
use App\Http\Requests\UpdateThreadRequest;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class ThreadController extends Controller
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
    public function store(StoreThreadRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Thread $thread)
    {
        $thread->load('Message', 'User');
        //dd($thread);
        return Inertia::render('MessangerChat')->with('Thread', $thread);;
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadRequest $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        //
    }

    public function create_show(User $user)
    {
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
        if ($Thread->isEmpty()) {
            $Thread = Thread::create();
            $Thread->User()->attach($user);
            $Thread->User()->attach(Request::user()->id);
            return redirect()->route('threads.show', ['thread' => $Thread->id]);
        } else {
            //dd($Thread); 
            return redirect()->route('threads.show', ['thread' => $Thread->first()->id]);
        }
        // if
    }
}
