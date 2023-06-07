<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $filable=[
        'name',
        'description',
        'path',
        'additional',
    ];

    public function GymMember(){
        return $this->belongsToMany(GymMember::class,'gym_member_documents','document_id','gym_member_id');
    }
}
