<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'notes',
        'status',
        'image',
        'slug',
    ];

    //rules
    public static function rules($id = 0)
    {
        return [
            'parent_id' => "nullable|exists:categories,id",
            'name' => ['required', 'string', 'min:3', 'max:255', "unique:categories,name,$id"],
            'notes' => "nullable|string",
            'image' => ['nullable'],
            'status' => ['nullable', 'in:active,inacteve'],
        ];
    }

    //Relationship
    public function parent()
    {
        return $this->belongsTo(Category::class)->withDefault(['name' => 'Category Primary']);
    }
    public function child()
    {
        return $this->hasMany(Category::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }

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


    //local scope filter chek name or created_at
    public function scopeFilter(Builder $builder, $filter)
    {
        if ($filter['name'] ?? false) {

            $builder->where('name', 'like', "%{$filter['name']}%");
        }

    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');
    }



    /*
if($filter['parent_id']  ?? false){
dd(1);
$builder->whereNotNull('parent_id');
}else{
dd(2);

$builder->whereNull('parent_id');
}
 */

}
