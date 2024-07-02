<?php

namespace Database\factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'value'     =>  $this->faker->randomFloat(2, 0, 1000),
			'place_id'  =>  Place::all()->pluck('id')->random(),
			'date'      =>  $this->faker->date('Y-m-d'),
		];
    }
}
