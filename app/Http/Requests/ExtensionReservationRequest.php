<?php

namespace App\Http\Requests;

class ExtensionReservationRequest extends GenericRequest
{
    public function rules()
    {
        $method = request()->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function storeValidator()
    {
        return [
			'reservation_id'  =>  'required|integer|exists:reservations,id',
			'extension_id'    =>  'required|integer|exists:extensions,id',
		];
    }

    private function updateValidator()
    {
        return [
			'reservation_id'  =>  'nullable|integer|exists:reservations,id',
			'extension_id'    =>  'nullable|integer|exists:extensions,id',
		];
    }
}
