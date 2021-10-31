<?php

namespace App\Http\Controllers\Api\V1\Passengers\Captains;

use App\Models\Captain;
use App\Models\Experience;
use App\Http\Controllers\Controller;
use App\Http\Resources\Passengers\Captains\CaptainCollection;
use App\Http\Resources\Passengers\Captains\CaptainLargeResource;
use App\Http\Resources\Captains\Experiences\ExperienceCollection;
use App\Http\Resources\Captains\Experiences\ExperienceLargeResource;
use Illuminate\Http\Request;

class CaptainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $captain = Captain::active()->NotSuspend()
        ->when($request->city_id, function ($q) use ($request) {
            $q->where('city_id', $request->city_id);
        })->when($request->country_id, function ($q) use ($request) {
            $q->where('country_id', $request->country_id);
        })->when($request->gender, function ($q) use ($request) {
            $q->where('gender', $request->gender);
        })->when($request->nationality_id, function ($q) use ($request) {
            $q->where('nationality_id', $request->nationality_id);
        })
        ->orderByDesc('rate')->limit(12)->get();

        return new CaptainCollection($captain);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Captain $captain)
    {
        if (!$captain) return $this->errorNotFound();
        
        return $this->respondWithItem(new CaptainLargeResource($captain));
    }
}
