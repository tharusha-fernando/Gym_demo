<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGymMemberAccountRequest;
use App\Http\Requests\CreateGymTrainerAccountRequest;
use App\Http\Requests\CreateUserRequest;
use App\Mail\GymOwnerAccountCreated;
use App\Models\GymMember;
use App\Models\GymTrainer;
use App\Models\GymOwner;
use App\Models\User;
use App\Notifications\GymMemberAccountCreated;
use App\Notifications\GymOwnerAccountCreated as NotificationsGymOwnerAccountCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class UserController extends Controller
{
    public function createGymOwneruser()
    {
        return Inertia::render('Admin/CreateGymOwnerAccount');
    }

    public function storeGymOwneruser(CreateUserRequest $request)
    {
        //dd($request);
        $input = $request->validated();
        //dd($data);

        $User = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        //Mail::send(new GymOwnerAccountCreated($User));
        //dd("asasasasa");
        $User->addRole('gym_owner');

        $GymOwner = new GymOwner();
        $GymOwner->gym_name = $User->name;
        $GymOwner->registration_number = "Reg Numbe";
        $GymOwner->user_id = $User->id;
        $GymOwner->save();
        Notification::send($User, new NotificationsGymOwnerAccountCreated($User));

        return redirect()->route('gym-owner.index')->with('message', "Gym Owner User Accout Has Been Created Successfully");
    }



    public function createGymMemberuser()
    {
        return Inertia::render('GymOwner/CreateGymMemberAccount');
    }


    public function storeGymMemberuser(CreateGymMemberAccountRequest $request)
    {
        //$gymOwner_=$request->user()->GymOwner->gym_name;
        //dd($gymOwner_);
        //dd($request);
        $input = $request->validated();
        //dd($data);

        $User = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        //Mail::send(new GymOwnerAccountCreated($User));
        //dd("asasasasa");
        $User->addRole('gym_member');
        $GymMember = new GymMember();
        $GymMember->user_id = $User->id;
        //$GymMember->gym_owner_id = $request->user()->GymOwner->id;
        //dd($GymTrainer);
        $GymMember->save();
        $GymMember->GymOwner()->attach($request->user()->GymOwner->id);
        Notification::send($User,new GymMemberAccountCreated($User));

        return redirect()->route('gym-member.index')->with('message', "Gym Member User Accout Has Been Created Successfully");
    }

    public function createGymTraineruser()
    {
        return Inertia::render('GymOwner/CreateGymTrainerAccount');
    }


    public function storeGymTraineruser(CreateGymTrainerAccountRequest $request)
    {
        //dd($request->user()->id); $request->user()->id
        $input = $request->validated();

        $User = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $User->addRole('gym_trainer');

        $gymTrainer = new GymTrainer();
        $gymTrainer->user_id = $User->id;
        $gymTrainer->details="Details Some ";
        $gymTrainer->save();
        $gymOwner = GymOwner::where('user_id',$request->user()->id)->get()->first();//GymOwner::find(Request::user()->id); // Assuming you have the gym_owner_id available
        //dd($gymOwner);
        $gymTrainer->GymOwners()->attach($gymOwner->id);

        return redirect()->route('gym-trainers.index')->with('message', "Gym Trainer User Account Has Been Created Successfully");
    }

    //
}

