<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GymOwner extends Model
{
    use HasFactory;

    protected $fillable=[
        'gym_name',
    'owner_name',
    'registration_number',
    'contact_phone',
    'address',
    'description',
    'logo',
    'opening_hours',
    'address',
    'social_media_links',
    'legal_docs',
    ];

    public function User(){
        return $this->BelongsTo(User::class);
    }

    public function GymMember(){

        return $this->belongsToMany(GymMember::class,'table_gym_member_gym_trainer','gym_owner_id','gym_member_id');
    }

    public function GymOwnerPayments(){
        return $this->hasMany(GymOwnerPayment::class);
    }

    public function GymMemberPayments(){
        return $this->hasMany(GymMemberPayment::class);
    }
    public function GymTrainerPayments(){
        return $this->hasMany(GymTrainerPayment::class);
    }

    public function GymTrainers(){
        return $this->belongsToMany(GymTrainer::class,'gym_owner_gym_trainer','gym_owner_id','gym_trainer_id');
    }

    //asasasasaasasasa
    //aasasasssasasasasasa
}
