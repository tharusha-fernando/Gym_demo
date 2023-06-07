<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymTrainerPayment extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'amount',
        'commission',
        'payment_type',
        'gym_trainer_id',
        'gym_owner_id',
        'profit'
    ];

    public function GymOwner(){
        return $this->belongsTo(GymOwner::class);
    }

    public function GymTrainer(){
        return $this->belongsTo(GymTrainer::class);
    }
}
