<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

abstract class Controller
{
    public function created(?JsonResource $resource = null): JsonResponse
    {
        return $this->respondResourceWithStatusCode($resource, Response::HTTP_CREATED);
    }

    public function accepted(?JsonResource $resource = null): JsonResponse
    {
        return $this->respondResourceWithStatusCode($resource, Response::HTTP_ACCEPTED);
    }

    public function ok(?JsonResource $resource = null): JsonResponse
    {
        return $this->respondResourceWithStatusCode($resource, Response::HTTP_OK);
    }

    public function unprocessable(): JsonResponse
    {
        return $this->respondResourceWithStatusCode(null, statusCode: Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    protected function respondResourceWithStatusCode(?JsonResource $resource, $statusCode): JsonResponse
    {
        return ($resource ?? new JsonResource([]))->response()->setStatusCode($statusCode);
    }
}
