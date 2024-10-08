<?php

namespace Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'name'   =>  $this->faker->name(),
			'image'  =>  $this->faker->imageUrl(640, 480),
		];
    }
}
