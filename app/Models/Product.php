<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category_id',
        'store_id',
        'name',
        'slug',
        'price',
        'discount',
        'notes',
        'status',
        'image',
    ];

    //rules
    public static function rules($id = 0)
    {
        return [
            'category_id' => "required",
            'name' => ['required', 'string', 'min:3', 'max:255', "unique:categories,name,$id"],
            'notes' => "nullable|string",
            'image' => ['nullable'],
            'status' => ['nullable', 'in:active,inactive'],
            'price' => ['nullable', 'min:0'],
            'discount' => ['nullable',  'min:0'],
        ];
    }

    //Relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    //local scope filter chek name or created_at
    public function scopeFilter(Builder $builder, $filter)
    {
        if ($filter['name'] ?? false) {
            $builder->where('name', 'like', "%{$filter['name']}%");
        }
        if ($filter['created_at'] ?? false) {
            $builder->whereDate('created_at', $filter['created_at']);
        }
    }

    public function scopeActive(Builder $builder){
          $builder->where('status','active');
    }
    //globle scope
    /*
public static function booted(){
static::addGlobalScope('store',function(Builder $builder){
$user=Auth::user();
if($user &&$user->store_id){
$builder->where('store_id','=',$user->store_id);
}

});

}*/
   //Accessors image
   public function getImageUrlAttribute()
   {
       if (!$this->image) {
           return 'https://www.firstcolonyfoundation.org/wp-content/uploads/2022/01/no-photo-available.jpeg';
       }
       if (Str::startsWith($this->image, ['http://', 'https://'])) {
           return $this->image;
       }
       return asset('storage/' . $this->image);
   }

   public function getSaleAttribute(){
    if(! $this->discount){
        return 0;
    }
    return round(100-(100* $this->price / $this->discount),1);
   }

   
}
