<?php

namespace Database\factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class AvailableTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'day'        =>  $this->faker->randomElement(['SUN', 'MON', 'TUS', 'WED', 'THU', 'FRI', 'SAT']),
			'from_time'  =>  $this->faker->date('H:i:s'),
			'to_time'    =>  $this->faker->date('H:i:s'),
			'is_Active'  =>  $this->faker->numberBetween(-128, 127),
			'place_id'   =>  Place::all()->pluck('id')->random(),
        ];
    }
}
