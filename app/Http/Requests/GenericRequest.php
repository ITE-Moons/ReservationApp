<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenericRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
}
