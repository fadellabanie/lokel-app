<?php

namespace App\Http\Controllers\API\V1\General;

use App\Models\City;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\Constants\CityResource;
use App\Http\Resources\Constants\NationalityResource;
use App\Http\Resources\Constants\CountryResource;
use App\Http\Resources\Constants\ConstResource;
use App\Models\Nationality;

class ConstantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCity()
    {
        $data = City::get();

        return $this->respondWithCollection(CityResource::collection($data));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCountry()
    {
        $data = Country::get();

        return $this->respondWithCollection(CountryResource::collection($data));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNationality()
    {
        $data = Nationality::get();

        return $this->respondWithCollection(NationalityResource::collection($data));
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreationConst()
    {
        $data['cities'] = City::get();
        $data['countries'] = Country::get();
        $data['nationalities'] = Nationality::get();


        return $this->respondWithCollection(new ConstResource($data));
    }
}
