<?php

namespace App\Http\Requests;

class CategoryRequest extends GenericRequest
{
    public function rules()
    {
        $method = request()->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function storeValidator()
    {
        return [
			'name'   =>  'required|string|max:255',
			'image'  =>  'required|image',
		];
    }

    private function updateValidator()
    {
        return [
			'name'   =>  'nullable|string|max:255',
			'image'  =>  'nullable|image',
		];
    }
}
