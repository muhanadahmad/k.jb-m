<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'store_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //rules
    public static function rules($id = false)
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'password' => 'required|min:6',
            'email' => "required||email|unique:users,email,$id",
            'status' => ['nullable', 'in:active,inacteve'],
            'store_id' => 'required',
        ];
    }
    //Relashen
    public function store()
    {
        return $this->belongsTo(Store::class)->withDefault(['name' => 'NO Store']);
    }

    //public function scopeFilter()
    public function scopeFilter(Builder $builder, $filter)
    {
        if ($filter['status'] ?? false) {
            $builder->where('status', '=', $filter['status']);
        }
        if ($filter['name'] ?? false) {
            $builder->where('name', 'like', "%{$filter['name']}%");
        }
    }

}
