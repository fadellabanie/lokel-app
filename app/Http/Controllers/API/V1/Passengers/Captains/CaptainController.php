<?php

namespace App\Http\Controllers\Api\V1\Passengers\Captains;

use App\Models\Captain;
use App\Models\Experience;
use App\Http\Controllers\Controller;
use App\Http\Resources\Passengers\Captains\CaptainCollection;
use App\Http\Resources\Passengers\Captains\CaptainLargeResource;
use App\Http\Resources\Captains\Experiences\ExperienceCollection;
use App\Http\Resources\Captains\Experiences\ExperienceLargeResource;

class CaptainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $captain = Captain::active()->orderBy('type', 'DESC')->paginate();

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
