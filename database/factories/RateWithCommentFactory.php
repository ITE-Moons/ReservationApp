<?php

namespace Database\factories;

use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RateWithCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'user_id'   =>  User::all()->pluck('id')->random(),
			'place_id'  =>  Place::all()->pluck('id')->random(),
			'text'      =>  $this->faker->text(65535),
			'rate'      =>  $this->faker->numberBetween(-2147483648, 2147483647),
		];
    }
}
