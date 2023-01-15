<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name=$this->faker->word();
        return [
            'parent_id' => $this->faker->randomElement(Category::pluck('id')),
            //'parint_id'=>Category::inRandomOrder()->first()->id,
            'name'=>$name,
            'slug'=>Str::slug($name),
            'notes'=>$this->faker->text(),
            'image'=>$this->faker->imageUrl(640,480),
        ];
    }
}
