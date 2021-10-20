<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\View;
use App\Models\Country;
use App\Models\ContractType;
use App\Models\RealestateType;
use App\Http\Controllers\Controller;
use App\Http\Resources\Constants\CityResource;
use App\Http\Resources\Constants\ViewResource;
use App\Http\Resources\Constants\CountryResource;
use App\Http\Resources\Constants\ContractTypeResource;
use App\Http\Resources\Constants\RealEstateTypeResource;

class ConstantController extends Controller
{

    const ADMIN = 'admin';
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRealEstateType()
    {
        $data = RealestateType::get();
     
        return $this->respondWithCollection(RealEstateTypeResource::collection($data));
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getContractType()
    {
        $data = ContractType::get();
     
        return $this->respondWithCollection(ContractTypeResource::collection($data));
    }/**
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
    public function getView()
    {
        $data = View::get();
     
        return $this->respondWithCollection(ViewResource::collection($data));
    }

}
