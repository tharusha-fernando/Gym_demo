<?php

namespace App\Http\Controllers;

use App\Models\GymMember;
use App\Http\Requests\StoreGymMemberRequest;
use App\Http\Requests\UpdateGymMemberRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class GymMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //$Users=User::with('GymOwner')->whereHas('roles', function ($query) {
        // $query->where('name', 'gym_owner');
        // })->get();

        //dd($GymMembers);
        //dd($Users);

        $GymMembers = GymMember::query()
            ->with('user.roles', 'GymSubscription')
            ->whereHas('user.roles', function ($query) {
                $query->where('name', 'gym_member');
            })->whereHas('GymOwner.User', function ($query) {
                $query->where('id', Request::user()->id);
            })
            ->orderBy('created_at', 'DESC');

        if (Request::input('search')) {
            // $GymMembers->whereHas('user', function ($query) {
            //   $query->where('name', Request::input('search'));
            // });

            $searchTerm = Request::input('search');
            $GymMembers->where('id', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('User', function ($query) use ($searchTerm) {
                    $query->where('email', 'like', '%' . $searchTerm . '%')
                        ->orWhere('name', 'like', '%' . $searchTerm . '%');
                });
        }

        $GymMembers = $GymMembers->paginate(5)->withQueryString();

        return Inertia::render('GymOwner/ViewMembers', compact('GymMembers'));
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
    public function store(StoreGymMemberRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GymMember $gymMember)
    {
        //$gymOwner->load('User');
        $gymMember->load('GymSubscription','User');
        //$gymOwner->load('User.Sub');
        $image = asset('storage/' . $gymMember->profile_pic);
        return Inertia::render('GymOwner/ShowGymMember', compact('gymMember', 'image'));

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymMember $gymMember)
    {
        $gymMember->load('User');
        $image = asset('storage/' . $gymMember->profile_pic);
        return Inertia::render('GymOwner/EditGymMember', compact('gymMember', 'image'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGymMemberRequest $request, GymMember $gymMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymMember $gymMember)
    {
        //
    }
}
