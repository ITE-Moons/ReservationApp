<?php

namespace Database\factories;

use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavouriteFactory extends Factory
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
		];
    }
}
