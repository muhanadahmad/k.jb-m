<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options',
    ];

    //Relashen
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault(['name'=>'Anonymous']);
    }
    //Globle Scope
    public static function booted(){
      //observer event
        static::creating(function(Cart $cart){
             $cart->id=Str::uuid();
        });
        static::creating(function(Cart $cart){
            $cart->cookie_id=Cart::cookie_id();
        });

        static::addGlobalScope('cart',function(Builder $builder){
           Cart::where('cookie_id',Cart::cookie_id());
        });
    }

    public static function cookie_id(){
        $cookie_id=Cookie::get('cart_id');
        if(! $cookie_id){
            $cookie_id=Str::uuid();
            Cookie::queue('cart_id',$cookie_id,30);
        }
        return $cookie_id;

    }


}
