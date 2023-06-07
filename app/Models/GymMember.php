<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymMember extends Model
{
    use HasFactory;

    public function GymOwner(){
    
        return $this->belongsToMany(GymOwner::class,'table_gym_member_gym_trainer','gym_member_id','gym_owner_id');
    }

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function GymMemberPayments(){
        return $this->hasMany(GymMemberPayment::class);
    }

    public function Document(){
        return $this->belongsToMany(Document::class,'gym_member_document','gym_member_id','document_id');
    }

    public function GymSubscription(){
        return $this->belongsTo(GymSubscription::class,'gym_subscription_id');
    }
}
