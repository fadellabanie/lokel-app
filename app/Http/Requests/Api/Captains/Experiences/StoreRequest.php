<?php

namespace App\Http\Requests\Api\Captains\Experiences;

use App\Http\Requests\Api\APIRequest;

class StoreRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city_id' => 'required|exists:cities,id',
            'title' => 'required|min:3|max:200',
            'description' => 'required|min:3',
            'thumbnail' => 'nullable',

            'icon' => 'required',
            'price' => 'required|gt:0',
            'duration' => 'required',
            'capacity' => 'required',
            'included' => 'required',
            'expect' => 'required',
            'faqs' => 'required',

            'pick_up_address' => 'required',
            'pick_up_lat' =>  ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'pick_up_lng' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'drop_of_address' => 'required',
            'drop_of_lat' =>  ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'drop_of_lng' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
         
        ];
    }
}
