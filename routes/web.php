<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\GymMemberController;
use App\Http\Controllers\GymMemberPaymentController;
use App\Http\Controllers\GymOwnerController;
use App\Http\Controllers\GymOwnerPaymentController;
use App\Http\Controllers\GymSubscriptionController;
use App\Http\Controllers\GymTrainerController;
use App\Http\Controllers\GymTrainerPaymentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    //Route::get('/dashboard', function () {
    //  return Inertia::render('Dashboard');
    //})->name('dashboard');
    //Auth Routes

    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');;

    Route::resource('notifications', NotificationController::class);;
    

    Route::resource('messages', MessageController::class);;

    Route::resource('threads', ThreadController::class);;
    
    Route::get('threads-init/{user}', [ThreadController::class,'create_show'])->name('threads-init');;
    

    



    Route::group(['middleware' => ['auth', 'role:administrator']], function () {
        Route::get('/admin-dashboard', [DashBoardController::class, 'adminDash'])->name('adminDash');
        Route::resource('gym-owner', GymOwnerController::class);
        Route::get('/account-create/gym-owner', [UserController::class, 'createGymOwneruser'])->name('gymOwnerAccountcreate');
        Route::post('/create-account/gym-owner/store', [UserController::class, 'storeGymOwneruser']);
        Route::get('/gym-owners/{gymOwner}/download-docs', [GymOwnerController::class, 'downloadDocs'])
            ->name('gym-owners.download-docs');

        Route::resource('gym-owner-payments',GymOwnerPaymentController::class);   
        Route::resource('subscription-packages',SubscriptionsController::class);  
        Route::resource('gym-owner-payments',GymOwnerPaymentController::class); 
        Route::get('gym-owner-payments/create/{gymOwner}',[GymOwnerPaymentController::class,'create'])->name('gym-owner-payments-seperate');
        
        Route::get('/gym-owner-payments/invoice',[GymOwnerPaymentController::class,'generateInvoicePDF'])->name('GymOwnerPaymentBasicInvoice'); 
    });

    Route::group(['middleware' => ['auth', 'role:gym_owner']], function () {
        Route::get('/gym-owner-dashboard', [DashBoardController::class, 'gymownerDashBoard'])->name('gymoDash');
        Route::resource('gym-member',GymMemberController::class);
        Route::get('/account-create/gym-member', [UserController::class, 'createGymMemberuser'])->name('gymMemberAccountcreate');
        Route::post('/create-account/gym-member/store', [UserController::class, 'storeGymMemberuser']);
        Route::resource('gym-subscriptions',GymSubscriptionController::class);
        Route::resource('gym-member-payments',GymMemberPaymentController::class);
        Route::resource('gym-trainers',GymTrainerController::class);
        Route::resource('gym-trainer-payments',GymTrainerPaymentController::class);

        Route::get('/gym-trainer-payments/invoice',[GymOwnerPaymentController::class,'generateInvoicePDF'])->name('GymTrainerPaymentBasicInvoice'); 
    
        

        Route::get('/account-create/gym-trainer', [UserController::class, 'createGymTraineruser'])->name('gymTrainerAccountcreate');
        Route::post('/create-account/gym-trainer/store', [UserController::class, 'storeGymTraineruser']);

        Route::get('gym-member-payments/create/{gymMember}',[GymMemberPaymentController::class,'create'])->name('gym-member-payments-seperate');
        Route::get('gym-trainer-payments/create/{gymTrainer}',[GymTrainerPaymentController::class,'create'])->name('gym-trainer-payments-seperate');
        

        Route::get('gym-owner/my-account',[GymTrainerPaymentController::class,'create'])->name('gym-trainer-payments-seperate');
        
        
    });

    
    Route::group(['middleware' => ['auth', 'role:gym_member']], function () {
        Route::get('/gym-member-dashboard', [DashBoardController::class, 'gymmemberDashBoard'])->name('gymmDash');
        
    });



    
});
