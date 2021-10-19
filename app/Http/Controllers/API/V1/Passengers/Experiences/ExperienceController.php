<?php

namespace App\Http\Controllers\Api\V1\Passengers\Experiences;

use App\Models\Experience;
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
    public function index()
    {
        $experience = Experience::active()->orderBy('type', 'DESC')->paginate();

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
