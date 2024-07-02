<?php

namespace Database\factories;

use App\Models\Type;
use App\Models\User;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'place_id'       =>  Place::all()->pluck('id')->random(),
			'user_id'        =>  User::all()->pluck('id')->random(),
			'type_id'        =>  Type::all()->pluck('id')->random(),
			'total_price'    =>  $this->faker->randomFloat(2, 0, 1000),
			'date_and_time'  =>  $this->faker->date('Y-m-d'),
		];
    }
}
