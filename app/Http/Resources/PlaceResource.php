<?php

namespace App\Http\Resources;
use App\Traits\ResourceTrait;
use Illuminate\Support\Facades\URL;
class PlaceResource extends GenericResource
{
    use ResourceTrait;
    public function toArray($request)
    {
        return [
			'id'                       =>  $this->id,
            'status'                   =>  $this->status,
            'is_favourite'             => $this->is_favourite ? 1 : 0,
			'name'                     =>  $this->name,
			'address'                  =>  $this->toResource($this->address, AddressResource::class),
			'owner_id'                 =>  $this->user('id')->get('name'),
			'maximum_capacity'         =>  $this->maximum_capacity,
			'price_per_hour'           =>  $this->price_per_hour,
			'space'                    =>  $this->space,
            'rate'                     =>  $this->rateWithComments()->average('rate'),
			'license'                  =>  isset($this->license) ? URL::asset('') . $this->license : null,
			'category_id'              =>  $this->category('id')->get('name'),
			'created_at'               =>  $this->created_at,
            'images'                   =>  isset($this->images) ? $this->toResource($this->images, ImageResource::class): null,
            'available_times'          =>  isset($this->availableTimes) ? $this->toResource($this->availableTimes, AvailableTimeResource::class): null,
            'types'                    =>  isset($this->types) ? $this->toResource($this->types, TypeResource::class): null,
            'extensions'               =>  isset($this->extensions) ? $this->toResource($this->extensions, ExtensionResource::class): null,
        ];
    }
}
