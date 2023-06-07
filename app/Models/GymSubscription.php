<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymSubscription extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','description','member_count','price','price__','gym_owner_id'
    ];

    public function GymOwner(){
        return $this->belongsTo(GymOwner::class,'gym_owner_id');
    }

    public function GymMember(){
        return $this->hasMany(GymMember::class);
    }
}
