<?php

namespace App\Http\Requests;

class UserRequest extends GenericRequest
{

    public function rules()
    {
        $method = request()->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function storeValidator()
    {
        return [
			'name'       =>  'required|string|max:255',
			'email'      =>  'required|string|max:255|unique:users,email',
			'password'   =>  'required|string|max:255',
			'user_name'  =>  'required|string|max:255|unique:users,user_name',
			'balance'    =>  'nullable|numeric',
		];
    }

    private function updateValidator()
    {
        return [
			'name'       =>  'nullable|string|max:255',
			'email'      =>  'nullable|string|max:255|unique:users,email,' . $this->id . ',id',
			'password'   =>  'nullable|string|max:255',
			'user_name'  =>  'nullable|string|max:255|unique:users,user_name,' . $this->id . ',id',
		];
    }

    private function chargeBalanceValidator(){
        return [
            'amount' => 'required|numeric',
        ];
    }

}
