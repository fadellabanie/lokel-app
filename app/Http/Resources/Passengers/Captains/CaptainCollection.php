<?php

namespace App\Http\Resources\Passengers\Captains;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CaptainCollection extends ResourceCollection
{

    public $collects = CaptainTinyResource::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        return [
            'status' => 1,
            'message' => __('Success Request'),
            'data' => parent::toArray($request),
        ];
    }
}
