<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashBoardController extends Controller
{
    public function index(){
        //dd(request()->user());
        if(request()->user()->hasRole('administrator')){
            return redirect('/admin-dashboard');
        }elseif(request()->user()->hasRole('gym_owner')){
            return redirect('/gym-owner-dashboard');
        }elseif(request()->user()->hasRole('gym_member')){
            return redirect('/gym-member-dashboard');
        }
        return redirect('/admin-dashboard');
    }

    public function adminDash(){
        return Inertia::render('Admin/AdminDashboard');
    }
    
    public function gymownerDashBoard(){
        return Inertia::render('GymOwner/GymownerDashboard');
    }
    
    public function gymmemberDashBoard(){
        return Inertia::render('GymMember/GymmemberDashboard');
    }
    
    //
}
