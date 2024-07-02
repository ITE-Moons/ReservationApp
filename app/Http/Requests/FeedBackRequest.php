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
			'user_id'   =>  'required|integer|exists:users,id',
			'place_id'  =>  'required|integer|exists:places,id',
			'text'      =>  'required|string|max:65535',
		];
    }

    private function updateValidator()
    {
        return [
			'user_id'   =>  'nullable|integer|exists:users,id',
			'place_id'  =>  'nullable|integer|exists:places,id',
			'text'      =>  'nullable|string|max:65535',
		];
    }
}