<?php

namespace App\Http\Resources\Constants;

use Illuminate\Http\Resources\Json\JsonResource;

class ConstResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'cities' => CityResource::collection($this['cities']),
           'countries' => CountryResource::collection($this['countries']),
           'nationalities' => NationalityResource::collection($this['nationalities']),
        ];
    }
}