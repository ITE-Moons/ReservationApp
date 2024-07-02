<?php

namespace App\Http\Requests;

class PasswordResetRequest extends GenericRequest
{
    public function rules()
    {
        $method = request()->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function storeValidator()
    {
        return [
			'email'  =>  'required|string|max:255',
			'token'  =>  'required|string|max:255',
		];
    }

    private function updateValidator()
    {
        return [
			'email'  =>  'nullable|string|max:255',
			'token'  =>  'nullable|string|max:255',
		];
    }
}
