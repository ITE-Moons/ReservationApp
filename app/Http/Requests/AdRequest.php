<?php

namespace App\Http\Requests;

class AdRequest extends GenericRequest
{
    public function rules()
    {
        $method = request()->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function storeValidator()
    {
        return [
			'image'        =>  'required|image',
			'description'  =>  'required|string|max:255',
		];
    }

    private function updateValidator()
    {
        return [
			'image'        =>  'required|image',
			'description'  =>  'required|string|max:255',
			'status'       =>  'required|integer',
		];
    }

    private function approveRequestValidator(){
        return [
            'id' => 'required|integer|exists:places,id'
        ];
    }

      private function rejectRequestValidator(){
        return [
            'id' => 'required|integer|exists:places,id'
        ];
    }
}
