<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Services\ImageService;
use App\Models\Image;

class ImageController extends GenericController
{
    private ImageService $imageService;


    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
        
        parent::__construct(new ImageRequest(), new ImageResource([]), new ImageService(new Image()));
    }
}
