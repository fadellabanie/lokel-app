<?php

namespace App\Http\Resources\Captains;

use Illuminate\Http\Resources\Json\JsonResource;

class CaptainResource extends JsonResource
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
            'full_name' => $this->first_name.' '.$this->last_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'country_code' => $this->country_code,
            'city_id' => $this->city->name,
            'country_id' => $this->country->name,
            'nationality_id' => $this->nationality->name,
            'avatar' => $this->avatar,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'avatar' => asset($this->avatar),
            'created_at' => (string) $this->created_at,
            'verified' =>(string) $this->mobile_verified_at,
            'token_type' => 'Bearer',
            'access_token' => $this->remember_token,
        ];
    }
}
