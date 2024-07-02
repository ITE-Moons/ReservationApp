<?php

namespace App\Http\Requests;

class FavouriteRequest extends GenericRequest
{
    public function rules()
    {
        $method = request()->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function storeValidator()
    {
        return [
			'place_id'  =>  'required|integer|exists:places,id',
		];
    }
    private function updateValidator()
    {
        return [
			'place_id'  =>  'nullable|integer|exists:places,id',
		];
    }
}
