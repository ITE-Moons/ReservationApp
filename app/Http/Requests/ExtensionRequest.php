<?php

namespace App\Http\Requests;

class ExtensionRequest extends GenericRequest
{
    public function rules()
    {
        $method = request()->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function storeValidator()
    {
        return [
			'name'         =>  'required|string|max:255',
			'place_id'     =>  'required|integer|exists:places,id',
			'description'  =>  'required|string|max:255',
			'price'        =>  'required|numeric',
		];
    }

    private function updateValidator()
    {
        return [
			'name'         =>  'required|string|max:255',
			'place_id'     =>  'required|integer|exists:places,id',
			'description'  =>  'required|string|max:255',
			'price'        =>  'required|numeric',
		];
    }
}
