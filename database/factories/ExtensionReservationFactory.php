<?php

namespace Database\factories;

use App\Models\Extension;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExtensionReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'reservation_id'  =>  Reservation::all()->pluck('id')->random(),
			'extension_id'    =>  Extension::all()->pluck('id')->random(),
		];
    }
}
