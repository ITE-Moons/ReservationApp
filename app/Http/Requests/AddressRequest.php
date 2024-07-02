<?php

namespace App\Http\Requests;

class AddressRequest extends GenericRequest
{
    public function rules()
    {
        $method = request()->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function storeValidator()
    {
        return [
            'place_id'   =>  'required|integer|exists:places,id',
			'goverment'  =>  'required|string|max:255',
			'city'       =>  'required|string|max:255',
			'area'       =>  'required|string|max:255',
			'street'     =>  'required|string|max:255',
		];
    }

    private function updateValidator()
    {
        return [
			'goverment'  =>  'nullable|string|max:255',
			'city'       =>  'nullable|string|max:255',
			'area'       =>  'nullable|string|max:255',
			'street'     =>  'nullable|string|max:255',
		];
    }
}
