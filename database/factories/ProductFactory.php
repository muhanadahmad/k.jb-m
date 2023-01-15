<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name=$this->faker->sentence(2);
        return [
            'store_id' => $this->faker->randomElement(Store::pluck('id')),
            'category_id' => $this->faker->randomElement(Category::pluck('id')),
            'name'=>$name,
            'slug'=>Str::slug($name),
            'price'=>$this->faker->randomFloat(1,1,500),//ععدد الخانات / اقل قيمة / اعلى قيمة
            'discount'=>$this->faker->randomFloat(1,500,999),
            'image'=>$this->faker->imageUrl,
            'notes'=>$this->faker->sentence(10),

        ];
    }
}
