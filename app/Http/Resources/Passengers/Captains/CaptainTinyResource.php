<?php

namespace App\Http\Resources\Passengers\Captains;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Constants\InterestResource;

class CaptainTinyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'mobile' => $this->mobile,
            'rate' => $this->rate,
            'avatar' => asset($this->avatar),
        ];
    }
}
