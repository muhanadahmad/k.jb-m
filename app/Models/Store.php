<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'notes',
        'status',
        'logo_image',
        'cover_image',
    ];

    //Rules
    public static function rules($id = 0)
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255', "unique:stores,name,$id"],
            'notes' => "nullable|string",
            'logo_image' => ['nullable'],
            'cover_image' => ['nullable'],
            'status' => ['nullable', 'in:active,inactive'],
        ];
    }

    //Relashen
    public function user()
    {
        return $this->hasMany(User::class);
    }

      //local scope filter chek name or created_at
      public function scopeFilter(EloquentBuilder $builder, $filter)
      {
          if ($filter['name'] ?? false) {
              $builder->where('name', 'like', "%{$filter['name']}%");
          }
          if ($filter['created_at'] ?? false) {
              $builder->whereDate('created_at', $filter['created_at']);
          }
      }

}
