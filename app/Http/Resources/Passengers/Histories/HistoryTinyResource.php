<?php

namespace App\Http\Resources\Passengers\Histories;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryTinyResource extends JsonResource
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
            'captain' => [
                'full_name' => $this->captain->first_name . ' ' . $this->captain->last_name,
                'avatar' => asset($this->captain->avatar),
                'rate' => $this->captain->rate,
                'number_of_trips' => $this->captain->number_of_trips,
            ]
        ];
    }
}
