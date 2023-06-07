<?php

namespace App\Http\Controllers;

use App\Models\GymTrainer;
use App\Http\Requests\StoreGymTrainerRequest;
use App\Http\Requests\UpdateGymTrainerRequest;
use App\Models\GymOwner;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class GymTrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $authUserGymId = GymOwner::where('user_id', Request::user()->id)->get()->first(); //GymOwner::find(Request::user()->id);$request->user()->id
        //dd($authUserId)
        //dd($authUserGymId);

        $GymTrainers = GymTrainer::query()
            ->whereHas('GymOwners', function ($query) use ($authUserGymId) {
                $query->where('user_id', $authUserGymId->user_id);
            })
            ->with('User.roles', 'GymOwners', 'User', 'GymOwners.User')
            ->orderBy('created_at', 'DESC');

        if (Request::input('search')) {
            $searchTerm = Request::input('search');
            $GymTrainers->where('id', 'like', '%' . $searchTerm . '%')->orWhere('trainer_name', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('User', function ($query) use ($searchTerm) {
                    $query->where('email', 'like', '%' . $searchTerm . '%')
                        ->orWhere('name', 'like', '%' . $searchTerm . '%');
                });
        }

        $GymTrainers = $GymTrainers->paginate(5)->withQueryString();

        return Inertia::render('GymOwner/ViewTrainers', compact('GymTrainers'));
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
    public function store(StoreGymTrainerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GymTrainer $gymTrainer)
    {
        //$gymOwner->load('User');
        $gymTrainer->load('User');
        //$gymOwner->load('User.Sub');
        $image = asset('storage/' . $gymTrainer->user->profile_photo_path);
        return Inertia::render('GymOwner/ShowGymTrainer', compact('gymTrainer', 'image'));

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymTrainer $gymTrainer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGymTrainerRequest $request, GymTrainer $gymTrainer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymTrainer $gymTrainer)
    {
        //
    }
}
