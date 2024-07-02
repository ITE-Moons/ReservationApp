<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExtensionRequest;
use App\Http\Resources\ExtensionResource;
use App\Services\ExtensionService;
use App\Models\Extension;

class ExtensionController extends GenericController
{
    private ExtensionService $extensionService;


    public function __construct(ExtensionService $extensionService)
    {
        $this->extensionService = $extensionService;
        
        parent::__construct(new ExtensionRequest(), new ExtensionResource([]), new ExtensionService(new Extension()));
    }
}
