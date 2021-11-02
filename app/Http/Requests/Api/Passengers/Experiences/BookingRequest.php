<?php

namespace App\Http\Requests\Api\Passengers\Experiences;

use App\Http\Requests\Api\APIRequest;

class BookingRequest extends APIRequest
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
            'experience_id' => ['required', 'exists:experiences,id']
        ];
    }
}
