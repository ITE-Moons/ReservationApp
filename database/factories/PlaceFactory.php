<?php

namespace Database\factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'name'              =>  $this->faker->name(),
			'address_id'        =>  Address::all()->pluck('id')->random(),
			'owner_id'          =>  User::all()->pluck('id')->random(),
			'maximum_capacity'  =>  $this->faker->numberBetween(-2147483648, 2147483647),
			'price_per_hour'    =>  $this->faker->randomFloat(2, 0, 1000),
			'date_of_add'       =>  $this->faker->date('Y-m-d'),
			'space'             =>  $this->faker->randomFloat(2, 0, 1000),
			'rate'              =>  $this->faker->randomFloat(2, 0, 1000),
			'license'           =>  $this->faker->text(65535),
			'category_id'       =>  Category::all()->pluck('id')->random(),
			'status'            =>  $this->faker->numberBetween(-128, 127),
		];
    }
}
