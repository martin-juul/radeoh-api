<?php

namespace App\Http\Resources\Traits;

/**
 * @mixin \Illuminate\Http\Resources\Json\JsonResource
 */
trait ApplyJsonEncodingOptions
{
    /**
     * Applies json encoding options
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\JsonResponse $response
     *
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setEncodingOptions($response->getEncodingOptions() | JSON_UNESCAPED_SLASHES);
    }
}
