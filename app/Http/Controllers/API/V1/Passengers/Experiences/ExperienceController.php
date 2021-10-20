<?php

namespace App\Http\Controllers\Api\V1\Passengers\Experiences;

use App\Models\Experience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Captains\Experiences\ExperienceCollection;
use App\Http\Resources\Captains\Experiences\ExperienceLargeResource;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $experience = Experience::active()
            ->when($request->city_id, function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            })->when($request->country_id, function ($q) use ($request) {
                $q->where('country_id', $request->country_id);
            })->when($request->price_from && $request->price_to, function ($q) use ($request) {
                $q->whereBetween('price', [$request->price_from, $request->price_to]);
            })
            ->orderBy('type', 'DESC')->paginate();

        return new ExperienceCollection($experience);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Experience $experience)
    {
        if (!$experience) return $this->errorNotFound();

        return $this->respondWithItem(new ExperienceLargeResource($experience));
    }
}
