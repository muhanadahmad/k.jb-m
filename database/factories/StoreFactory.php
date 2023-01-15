<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
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
            'name'=>$name,
            'slug'=>Str::slug($name),
            'logo_image'=>$this->faker->imageUrl,
            'cover_image'=>$this->faker->imageUrl,
            'notes'=>$this->faker->sentence(10),

        ];
    }
}
