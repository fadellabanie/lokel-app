<?php

namespace App\Http\Resources\Captains\Histories;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryPassengersTinyResource extends JsonResource
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
           // 'id' => $this->id,
            'full_name' => $this->full_name,
            'code' => $this->code,
            'avatar' => asset($this->avatar),
        ];
    }
}
