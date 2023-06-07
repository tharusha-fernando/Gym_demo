<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymTrainer extends Model
{
    use HasFactory;

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function GymTrainerPayments(){
        return $this->hasMany(GymTrainerPayment::class);
    }

    public function GymOwners(){
        return $this->belongsToMany(GymOwner::class,'gym_owner_gym_trainer','gym_trainer_id','gym_owner_id');
    }

    //asasasasaasasasas
    //asasaaasassaasasa
}
