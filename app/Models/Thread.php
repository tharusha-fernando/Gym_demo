<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','description'
    ];

    public function User(){
        return $this->belongsToMany(User::class,'table_thread_user','thread_id','user_id');
    }

    public function Message(){
        return $this->hasMany(Message::class,'thread_id');
    }


}
