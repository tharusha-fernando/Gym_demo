<?php

namespace App\Http\Controllers;

use App\Models\GymOwner;
use App\Http\Requests\StoreGymOwnerRequest;
use App\Http\Requests\UpdateGymOwnerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;


class GymOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$Users=User::with('GymOwner')->whereHas('roles', function ($query) {
        // $query->where('name', 'gym_owner');
        // })->get();

         //dd($GymOwners);
        //dd($Users);

        $GymOwners = GymOwner::query()
        ->with('user.roles', 'user.subscriptions')
        ->whereHas('user.roles', function ($query) {
            $query->where('name', 'gym_owner');
        })
        ->orderBy('created_at', 'DESC');
    
    if (Request::input('search')) {
       // $GymOwners->whereHas('user', function ($query) {
         //   $query->where('name', Request::input('search'));
       // });

        $searchTerm = Request::input('search');
        $GymOwners->where('id', 'like', '%' . $searchTerm . '%')
        ->orWhere('gym_name', 'like', '%' . $searchTerm . '%')->orWhereHas('User', function ($query) use ($searchTerm) {
            $query->where('email', 'like', '%' . $searchTerm . '%')
                ->orWhere('name', 'like', '%' . $searchTerm . '%');
        });

    
    }
    
    $GymOwners = $GymOwners->paginate(5)->withQueryString();
    
    return Inertia::render('Admin/ViewOwner', compact('GymOwners'));
    
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/AddOwner');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGymOwnerRequest $request)
    {
        $data = $request->validated();
        dd($data);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GymOwner $gymOwner)
    {
        //$gymOwner->load('User');
        $gymOwner->load('User.Subscriptions');
        //$gymOwner->load('User.Sub');
        $image = asset('storage/' . $gymOwner->logo);
        return Inertia::render('Admin/ShowGymOwner', compact('gymOwner','image'));

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymOwner $gymOwner)
    {
        
        $image = asset('storage/' . $gymOwner->logo);
        return Inertia::render('Admin/EditGymOwner', compact('gymOwner', 'image'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGymOwnerRequest $request, GymOwner $gymOwner)
    {
        $data = $request->validated();
        //dd($request->file('legal_docs'));

        if ($request->hasFile('logo')) {
            $filePath = strval($gymOwner->logo);
            //dd($filePath);
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            //Storage::delete('public/' . $gymOwner->logo);
            $logo = $request->file('logo')->store('gym_owner', 'public');
            $data['logo'] = $logo;
        } else {
            $data['logo'] = $gymOwner->logo;
        }

        if ($request->hasFile('legal_docs')) {
            $filePath = strval($gymOwner->legal_docs);
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            //Storage::delete('public/' . $gymOwner->legal_docs);
            $legalDocs = $request->file('legal_docs')->store('gym_owner', 'public');
            //dd($legalDocs);
            $data['legal_docs'] = $legalDocs;
            //dd($data);
        } else {
            $data['legal_docs'] = $gymOwner->legal_docs;
        }
        //dd($data);
        $gymOwner->update($data);
        //dd($gymOwner);

        return redirect()->route('gym-owner.index')->with('message', "Gym Owner has been updated successfully");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymOwner $gymOwner)
    {
        //
    }



    

    public function downloadDocs(GymOwner $gymOwner)
    {
        $filePath = strval($gymOwner->legal_docs);
        $fileName = pathinfo($filePath, PATHINFO_FILENAME);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    
        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => "attachment; filename=\"$fileName.$extension\"",
        ];
    
        $disk = Storage::disk('public');
        $fileExists = $disk->exists($filePath);
    
        if ($fileExists) {
            return response()->streamDownload(function () use ($disk, $filePath) {
                echo $disk->get($filePath);
            }, "$fileName.$extension", $headers);
        } else {
            abort(404, 'File not found.');
        }
    }

}
