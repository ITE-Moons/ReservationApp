<?php

namespace App\Http\Requests;

class FeedBackRequest extends GenericRequest
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
			'text'      =>  'required|string|max:65535',
		];
    }

    private function updateValidator()
    {
        return [
			'place_id'  =>  'nullable|integer|exists:places,id',
			'text'      =>  'nullable|string|max:65535',
		];
    }
}
