<?php

namespace App\Http\Controllers;

use App\Models\GymOwnerPayment;
use App\Http\Requests\StoreGymOwnerPaymentRequest;
use App\Http\Requests\UpdateGymOwnerPaymentRequest;
use App\Models\GymOwner;
use App\Models\Subscriptions;
use App\Models\User;
use App\Notifications\GymOwnerPackageActivated;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Notification;

date_default_timezone_set('Asia/Colombo');

class GymOwnerPaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $GymOwnerPayments = GymOwnerPayment::query()
            ->with('GymOwner.User', 'User');

        if (Request::input('search')) {
            $searchTerm = Request::input('search');
            $GymOwnerPayments->where(function ($query) use ($searchTerm) {
                $query->whereHas('GymOwner', function ($query) use ($searchTerm) {
                    $query->where('id', 'like', '%' . $searchTerm . '%')
                        ->orWhere('gym_name', 'like', '%' . $searchTerm . '%');
                }); 
            });
        }
        if (Request::input('date_from') != '' && Request::input('date_to') != '') {
            $GymOwnerPayments->whereBetween('created_at', [Request::input('date_from'), Request::input('date_to')]);
        }
        $GymOwnerPayments = $GymOwnerPayments->orderBy('id', 'DESC')->paginate(5);
        return Inertia::render('Admin/ViewPayments')->with('GymOwnerPayments', $GymOwnerPayments);;
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GymOwner $gymOwner = null)
    {
        //dd($gymOwner); //sdsdsdsdsd
        return Inertia::render('Admin/AddGymOwnerPayments', compact('gymOwner'));

        //dd($gymOwner);   //asasasasasasasa
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGymOwnerPaymentRequest $request)
    {
        $data = $request->validated();
        $profit = ['profit' => strval((($data['amount'] / 100) * (100 - $data['commission'])) * 100)];
        $data = array_merge($profit, $data);
        $amount = $data['amount'];
        $data['amount'] = strval($data['amount'] * 100);
        //dd($data);
        $Subscription = Subscriptions::where('price', $data['amount'])->first();
        $gymOwner = GymOwner::find($data['gym_owner_id']);
        //dd($Subscription);
        if ($Subscription == null) {
            //dd($gymOwner);
            return redirect()->route('gym-owner-payments-seperate', $gymOwner->id)->with('alert', 'No  Subscription Macthes This Amount');
        }
        //dd($data);
        $Payment=GymOwnerPayment::create($data);
        $User = User::find($gymOwner->user_id);
        $User->subendate = Carbon::now()->addDays(30);
        $User->subscrition = $Subscription->id;
        $User->save();
        Notification::send($User,new GymOwnerPackageActivated($User,$Payment));
        return redirect()->route('gym-owner.show', $gymOwner)->with('message', 'New Subsciption Has Been Activated');

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GymOwnerPayment $gymOwnerPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymOwnerPayment $gymOwnerPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGymOwnerPaymentRequest $request, GymOwnerPayment $gymOwnerPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymOwnerPayment $gymOwnerPayment)
    {
        //
    }



    public function generateInvoicePDF()
    {
        $GymOwnerPayments = GymOwnerPayment::query()
            ->with('GymOwner.User', 'User');

        if (Request::input('search')) {
            $searchTerm = Request::input('search');
            $GymOwnerPayments->where(function ($query) use ($searchTerm) {
                $query->whereHas('GymOwner', function ($query) use ($searchTerm) {
                    $query->where('id', 'like', '%' . $searchTerm . '%')
                        ->orWhere('gym_name', 'like', '%' . $searchTerm . '%');
                }); 
            });
        }

        if (Request::input('date_from') != '' && Request::input('date_to') != '') {
            $GymOwnerPayments->whereBetween('created_at', [Request::input('date_from'), Request::input('date_to')]);
        }

        $GymOwnerPayments = $GymOwnerPayments->orderBy('id', 'DESC')->get();
        dd($GymOwnerPayments);
        $Collection = collect($data->items());
        dd($Collection);
        $GymOwnerPayments = GymOwnerPayment::query()
            ->with('GymOwner.User', 'User')
            ->paginate(5);

        $pdf = Pdf::loadView('invoice', compact('GymOwnerPayments'));

        return $pdf->download('invoice.pdf');
    }
}
