<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Services\AddressService;
use App\Models\Address;

class AddressController extends GenericController
{
    private AddressService $addressService;


    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
        
        parent::__construct(new AddressRequest(), new AddressResource([]), new AddressService(new Address()));
    }
}
