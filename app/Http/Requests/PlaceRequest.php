<?php

namespace App\Http\Requests;

class PlaceRequest extends GenericRequest
{
    public function rules()
    {
        $method = request()->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function storeValidator()
    {
        return [
			'name'                     =>  'required|string|max:255',
            'address.goverment'       =>  'required|string|max:255',
            'address.city'            =>  'required|string|max:255',
            'address.area'            =>  'required|string|max:255',
            'address.street'          =>  'required|string|max:255',
			'maximum_capacity'         =>  'required|integer',
			'price_per_hour'           =>  'required|numeric',
			'space'                    =>  'required|numeric',
			'license'                  =>  'required|image',
			'category_id'              =>  'required|integer|exists:categories,id',
            'day_hour'                 =>  'required|in:DAYS,HOURS',
            'images'                   =>  'required|array',
            'images.*'                 =>  'required|image',
            'available_times'           =>  'required|array',
            'available_times.*.day'        =>  'required|in:Sun,Mon,Tue,Wed,Thu,Fri,Sat',
			'available_times.*.from_time'  =>  'required|date_format:H:i',
			'available_times.*.to_time'    =>  'required|date_format:H:i',
			'available_times.*.is_Active'  =>  'required|integer',
            'types'                       => 'array',
            'types.*'                     => 'required|string|max:255',
            'extensions'                 => 'array',
            'extensions.*.name'         =>  'required|string|max:255',
            'extensions.*.description'  =>  'required|string|max:255',
            'extensions.*.price'        =>  'required|numeric',
		];
    }

    private function updateValidator()
    {
        return [
			'name'                     =>  'nullable|string|max:255',
			'maximum_capacity'         =>  'nullable|integer',
			'price_per_hour'           =>  'nullable|numeric',
            'images'                   =>  'nullable|array',
            'images.*'                 =>  'required|image',
            'available_times'           =>  'nullable|array',
            'available_times.*.day'        =>  'required|in:Sun,Mon,Tue,Wed,Thu,Fri,Sat',
			'available_times.*.from_time'  =>  'required|date_format:H:i',
			'available_times.*.to_time'    =>  'required|date_format:H:i',
			'available_times.*.is_Active'  =>  'required|integer',
            'types'                       => 'nullable|array',
            'types.*'                     => 'required|string|max:255',
            'extensions'                 => 'nullable|array',
            'extensions.*.name'         =>  'required|string|max:255',
            'extensions.*.description'  =>  'required|string|max:255',
            'extensions.*.price'        =>  'required|numeric',
		];
    }


    private function searchValidator(){
        return [
            'name'=> 'required|string|max:255'
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

    private function getPlacesByCatIdValidator(){
        return [
            'id' => 'required|integer|exists:categories,id'
        ];
    }

    private function filterPlaceValidator(){
        return [
        'by_price' => 'nullable|integer',
        'sort_by_price' => 'nullable|in:asc,desc',
        'sort_by_rate' => 'nullable|in:asc,desc'
        ];
    }
}
