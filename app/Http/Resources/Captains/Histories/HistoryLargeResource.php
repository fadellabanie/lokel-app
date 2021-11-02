<?php

namespace App\Http\Resources\Captains\Histories;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryLargeResource extends JsonResource
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
            'title' => $this->title,
            'code' => $this->code,
            'price' => $this->price,
            'pick_up_address' => $this->pick_up_address,
            'drop_of_address' => $this->drop_of_address,
            'icon' =>  asset($this->icon),
            'passengers' => HistoryPassengersTinyResource::collection($this->passengers),
        ];
    }
}
