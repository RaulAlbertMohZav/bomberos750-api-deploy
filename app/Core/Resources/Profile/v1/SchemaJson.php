<?php

namespace App\Core\Resources\Profile\v1;

use App\Core\Resources\Profile\v1\Interfaces\ProfileInterface;
use App\Http\Resources\Api\User\v1\UserResource;

class SchemaJson implements ProfileInterface
{

    protected CacheApp $cacheApp;

    public function __construct(CacheApp $cacheApp)
    {
        $this->cacheApp = $cacheApp;
    }

    public function getDataMyProfile()
    {
        return UserResource::make($this->cacheApp->getDataMyProfile());
    }

    public function updateDataMyProfile($request)
    {
        return UserResource::make($this->cacheApp->updateDataMyProfile($request));
    }

    public function unsubscribeFromSystem()
    {
        return response()->json([
            'message' => $this->cacheApp->unsubscribeFromSystem()
        ], 200);
    }

    public function changePasswordAuth($request)
    {
        return response()->json([
            'message' => $this->cacheApp->changePasswordAuth($request)
        ], 200);
    }
}