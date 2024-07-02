<?php

namespace Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'goverment'  =>  $this->faker->text(255),
			'city'       =>  $this->faker->city(),
			'area'       =>  $this->faker->text(255),
			'street'     =>  $this->faker->streetName(),
		];
    }
}
