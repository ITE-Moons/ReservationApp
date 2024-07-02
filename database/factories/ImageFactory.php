<?php

namespace Database\factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'image'     =>  $this->faker->imageUrl(640, 480),
			'place_id'  =>  Place::all()->pluck('id')->random(),
		];
    }
}
