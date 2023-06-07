<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymOwnerPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'commission',
        'payment_type',
        'gym_owner_id',
        'profit'
    ];

    public function GymOwner()
    {
        return $this->belongsTo(GymOwner::class,'gym_owner_id');
    }

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}
