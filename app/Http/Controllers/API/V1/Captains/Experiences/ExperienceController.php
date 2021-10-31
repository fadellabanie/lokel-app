<?php

namespace App\Http\Controllers\Api\V1\Captains\Experiences;

use App\Models\Experience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\ExperienceService;
use App\Http\Requests\Api\Captains\Experiences\StoreRequest;
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
        $experience = Experience::my()->orderBy('type', 'DESC')->paginate();

        return new ExperienceCollection($experience);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $request['captain_id'] = Auth::id();
        $response = ExperienceService::create($request);

        if (!$response['success']) {
            return $this->errorStatus($response['message']);
        }
        return $this->successStatus('waiting admin approve this experience');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Experience $experience)
    {
        if (!$experience) return $this->errorNotFound();
        $response = ExperienceService::update($request,$experience);

        if (!$response['success']) {
            return $this->errorStatus($response['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experience $experience)
    {
        if (!$experience) return $this->errorNotFound();

        if ($experience->status == Experience::ACCEPT) return $this->errorStatus('can not delete this experience');

        $experience->delete();

        return $this->successStatus('deleted successfully');
    }
}
