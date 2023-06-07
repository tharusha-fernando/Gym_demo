<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymMemberPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'commission',
        'payment_type',
        'gym_member_id',
        'gym_owner_id',
        'profit'
    ];


    public function GymOwner(){
        return $this->belongsTo(GymOwner::class);
    }

    public function GymMember(){
        return $this->belongsTo(GymMember::class);
    }
}
