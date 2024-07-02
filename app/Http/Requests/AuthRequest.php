<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $method = $this->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function loginValidator()
    {
        return [
            'user_name'    => 'required|string|max:50',
            'password'         => 'required|string|min:6|max:50'
        ];
    }

    private function registerValidator()
    {
        return [
            'name'          =>  'required|string|max:100',
            'user_name'     =>  'required|string|max:50|unique:users,user_name',
            'email'          =>  'nullable|string|max:254|unique:users,email',
            'password'       =>  'required|string|confirmed|min:6|max:100',
        ];
    }

    private function updateProfileValidator()
    {
        return [
            'password'      =>  'nullable|string|min:6',
            'user_name'     =>  'nullable|string|max:50|unique:users,user_name,' . Auth::id() . ',id',
            'email'          =>  'nullable|string|max:254|unique:users,email,' . Auth::id() . ',id',
        ];
    }
}
