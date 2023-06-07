<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','description','member_count','price','price__'
    ];

    

    
}
