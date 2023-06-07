<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;


class User extends Authenticatable implements LaratrustUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function GymOwner(){
        return $this->HasOne(GymOwner::class);
    }

    public function GymMember(){
        return $this->hasOne(GymMember::class);
    }

    public function GymTrainer(){
        return $this->hasOne(GymTrainer::class);
    }

    public function Subscriptions(){
        return $this->belongsTo(Subscriptions::class,'subscrition');
    }

    public function Thread(){
        return $this->belongsToMany(Thread::class,'table_thread_user','user_id','thread_id');
    }

    public function Message(){
        return $this->hasMany(Message::class,'user_id');
    }
}
