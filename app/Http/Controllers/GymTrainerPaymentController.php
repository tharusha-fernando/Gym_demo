<?php

namespace App\Http\Controllers;

use App\Models\GymTrainerPayment;
use App\Http\Requests\StoreGymTrainerPaymentRequest;
use App\Http\Requests\UpdateGymTrainerPaymentRequest;
use App\Models\GymTrainer;
use App\Notifications\GymTrainerPaymentNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class GymTrainerPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Request::user()->id
        //        Request::user()->id
        //Request::user()->id
        //        Request::user()->id

        $gymTrainerPayment = GymTrainerPayment::query()
            ->with('GymTrainer.User', 'GymTrainer', 'GymOwner',)
            ->where('gym_owner_id', Request::user()->id);

        if (Request::input('search')) {
            $searchTerm = Request::input('search');
            $gymTrainerPayment->where(function ($query) use ($searchTerm) {
                $query->whereHas('GymTrainer', function ($query) use ($searchTerm) {
                    $query->where('id', 'like', '%' . $searchTerm . '%');
                        //->orWhere('id', 'like', '%' . $searchTerm . '%');
                });
            });
        }
        if (Request::input('date_from') != '' && Request::input('date_to') != '') {
            $gymTrainerPayment->whereBetween('created_at', [Request::input('date_from'), Request::input('date_to')]);
        }
        $gymTrainerPayment = $gymTrainerPayment->orderBy('id', 'DESC')->paginate(5);
        return Inertia::render('GymOwner/ViewTrainerPayments')->with('GymTrainerPayments', $gymTrainerPayment);;


        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GymTrainer $gymTrainer)
    {

        //dd($gymOwner); //sdsdsdsdsd
        $gymTrainer->load('User');
        return Inertia::render('GymOwner/AddGymTrainerPayments', compact('gymTrainer'));

        //dd($gymOwner);   //asasasasasasasa

        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGymTrainerPaymentRequest $request)
    {
        // dd($request->user());
        $data = $request->validated();
        $profit = ['profit' => strval((($data['amount'] / 100) * (100 - $data['commission'])) * 100)];
        $data = array_merge($profit, $data);
        $amount = $data['amount'];
        $data['amount'] = strval($data['amount'] * 100);
        //dd($data);
        //$Subscription = GymSubscription::where('gym_owner_id', $request->user()->id)->where('price', $data['amount'])->first();
        $gymTrainer = GymTrainer::find($data['gym_trainer_id']);
        //dd($Subscription);
       // if ($Subscription == null) {
            //dd($gymOwner);
           // return redirect()->route('gym-member-payments-seperate', $gymTrainer->id)->with('alert', 'No  Subscription Macthes This Amount');
        //}
        //dd($data);
        $Payment = GymTrainerPayment::create($data);
        //$User = User::find($gymOwner->user_id);
        //$gymTrainer->subenddate = Carbon::now()->addDays(30);
       // $gymTrainer->gym_subscription_id = $Subscription->id;
//$gymTrainer->save();
        //Notification::send($User,new GymOwnerPackageActivated($User,$Payment));
        Notification::send($gymTrainer->user, new GymTrainerPaymentNotification($gymTrainer->user,$request->user()->GymOwner,$Payment));
        //Notification::send($request->user(), new GymTrainerPaymentNotification($gymTrainer->user,$request->user()->GymOwner));
        return redirect()->route('gym-trainers.show', $gymTrainer)->with('message', 'Ne Payment Has Been Added');

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GymTrainerPayment $gymTrainerPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymTrainerPayment $gymTrainerPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGymTrainerPaymentRequest $request, GymTrainerPayment $gymTrainerPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymTrainerPayment $gymTrainerPayment)
    {
        //
    }
}
