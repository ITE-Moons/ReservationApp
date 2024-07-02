<?php

namespace Database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'user_id'      =>  User::all()->pluck('id')->random(),
			'image'        =>  $this->faker->imageUrl(640, 480),
			'description'  =>  $this->faker->text(255),
			'status'       =>  $this->faker->numberBetween(-128, 127),
		];
    }
}
