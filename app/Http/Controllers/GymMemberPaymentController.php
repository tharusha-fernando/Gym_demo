<?php

namespace App\Http\Controllers;

use App\Models\GymMemberPayment;
use App\Http\Requests\StoreGymMemberPaymentRequest;
use App\Http\Requests\UpdateGymMemberPaymentRequest;
use App\Models\GymMember;
use App\Models\GymSubscription;
use App\Notifications\GymMemberPaymentNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class GymMemberPaymentController extends Controller
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

        $GymMemberPayments = GymMemberPayment::query()
            ->with('GymMember.User', 'GymMember', 'GymOwner')
            ->whereHas('GymMember.GymOwner', function ($query) {
                $query->where('gym_owner_id', Request::user()->GymOwner->id);
            });

        if (Request::input('search')) {
            $searchTerm = Request::input('search');
            $GymMemberPayments->where(function ($query) use ($searchTerm) {
                $query->whereHas('GymMember', function ($query) use ($searchTerm) {
                    $query->where('id', 'like', '%' . $searchTerm . '%')
                        ->orWhere('nic', 'like', '%' . $searchTerm . '%');
                });
            });
        }
        if (Request::input('date_from') != '' && Request::input('date_to') != '') {
            $GymMemberPayments->whereBetween('created_at', [Request::input('date_from'), Request::input('date_to')]);
        }
        $GymMemberPayments = $GymMemberPayments->orderBy('id', 'DESC')->paginate(5);
        return Inertia::render('GymOwner/ViewGymMemberPayments')->with('GymMemberPayments', $GymMemberPayments);;

        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GymMember $gymMember = null)
    {
        //dd($gymOwner); //sdsdsdsdsd
        $gymMember->load('User');
        return Inertia::render('GymOwner/AddGymMemberPayments', compact('gymMember'));

        //dd($gymOwner);   //asasasasasasasa

        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGymMemberPaymentRequest $request)
    {
        // dd($request->user());
        $data = $request->validated();
        $profit = ['profit' => strval((($data['amount'] / 100) * (100 - $data['commission'])) * 100)];
        $data = array_merge($profit, $data);
        $amount = $data['amount'];
        $data['amount'] = strval($data['amount'] * 100);
        //dd($data);
        $Subscription = GymSubscription::where('gym_owner_id',$request->user()->id)->where('price', $data['amount'])->first();
        $gymMember = GymMember::find($data['gym_member_id']);
        //dd($Subscription);
        if ($Subscription == null) {
            //dd($gymOwner);
            return redirect()->route('gym-member-payments-seperate', $gymMember->id)->with('alert', 'No  Subscription Macthes This Amount');
        }
        //dd($data);
        $Payment=GymMemberPayment::create($data);
        //$User = User::find($gymOwner->user_id);
        $gymMember->subenddate = Carbon::now()->addDays(30);
        $gymMember->gym_subscription_id = $Subscription->id;
        $gymMember->save();
        //Notification::send($User,new GymOwnerPackageActivated($User,$Payment));
        Notification::send($gymMember->user,new GymMemberPaymentNotification($gymMember->user));
        Notification::send($request->user(),new GymMemberPaymentNotification($gymMember->user));
        return redirect()->route('gym-member.show', $gymMember)->with('message', 'Payment Approved , New Subsciption Has Been Activated');

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GymMemberPayment $gymMemberPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymMemberPayment $gymMemberPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGymMemberPaymentRequest $request, GymMemberPayment $gymMemberPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymMemberPayment $gymMemberPayment)
    {
        //
    }
}
