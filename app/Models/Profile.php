<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $primaryKey='user_id';

    protected $fillable = [
        'phone',
        'first_name',
        'last_name',
        'gender',
        'birthday',
        'national',
        'passport',
        'street_address',
        'city',
        'countray',
        'image',

    ];

    #Relation user one to one
    public function user(){
    return $this->belongsTo(User::class, 'user_id', 'id');
}
}
