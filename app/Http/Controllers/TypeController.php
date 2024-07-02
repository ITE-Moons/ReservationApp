<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use App\Services\TypeService;
use App\Models\Type;

class TypeController extends GenericController
{
    private TypeService $typeService;


    public function __construct(TypeService $typeService)
    {
        $this->typeService = $typeService;
        
        parent::__construct(new TypeRequest(), new TypeResource([]), new TypeService(new Type()));
    }
}
