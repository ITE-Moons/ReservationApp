<?php

namespace Database\factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'name'      =>  $this->faker->name(),
			'place_id'  =>  Place::all()->pluck('id')->random(),
		];
    }
}
