<?php

namespace App\Http\Resources\Passengers\Captains;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Constants\InterestResource;
use App\Http\Resources\Constants\CaptainGalleryResource;

class CaptainLargeResource extends JsonResource
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
            'bio' => $this->bio,
            'city' => $this->city->name,
            'nationality' => $this->nationality->name,
            'smoker' => (boolean) $this->smoker,
            'languages' => $this->languages,
            'number_of_trips' => (boolean) $this->smoker,
            'age' => calculateAge($this->birthday),
            'avatar' => asset($this->avatar),
            'interests' => InterestResource::collection($this->interests),
            'galleries' => CaptainGalleryResource::collection($this->galleries),
        ];
    }
}
