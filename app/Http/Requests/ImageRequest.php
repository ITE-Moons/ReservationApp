<?php

namespace App\Http\Requests;

class ImageRequest extends GenericRequest
{
    public function rules()
    {
        $method = request()->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function storeValidator()
    {
        return [
			'image'     =>  'required|string|max:65535',
			'place_id'  =>  'required|integer|exists:places,id',
		];
    }

    private function updateValidator()
    {
        return [
			'image'     =>  'nullable|string|max:65535',
			'place_id'  =>  'nullable|integer|exists:places,id',
		];
    }
}
