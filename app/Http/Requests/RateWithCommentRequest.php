<?php

namespace App\Http\Requests;

class RateWithCommentRequest extends GenericRequest
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
			'rate'      =>  'required|integer',
		];
    }
    private function updateValidator()
    {
        return [
			'text'      =>  'nullable|string|max:65535',
			'rate'      =>  'nullable|integer',
		];
    }

    private function getCommentsByPlaceIdValidator(){
        return [
            'place_id'  =>  'required|integer|exists:places,id'

        ];
    }
}
