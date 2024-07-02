<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Services\SubscriptionService;
use App\Models\Subscription;

class SubscriptionController extends GenericController
{
    private SubscriptionService $subscriptionService;


    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
        
        parent::__construct(new SubscriptionRequest(), new SubscriptionResource([]), new SubscriptionService(new Subscription()));
    }
}
