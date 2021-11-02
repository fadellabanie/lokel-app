<?php

namespace App\Http\Controllers\Api\V1\Passengers\Experiences;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\Passengers\Experiences\BookingRequest;
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
        $experience = Experience::accept()
            ->when($request->city_id, function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            })->when($request->country_id, function ($q) use ($request) {
                $q->where('country_id', $request->country_id);
            })->when($request->price_from && $request->price_to, function ($q) use ($request) {
                $q->whereBetween('price', [$request->price_from, $request->price_to]);
            })
            ->orderByDESC('id')->paginate();

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function booking(BookingRequest $request)
    {
        DB::beginTransaction();
        try {
            $experience =  Experience::with('passengers')->find($request->experience_id);

            $experience->passengers()->attach([Auth::id()]);

            ## send notification 
            DB::commit();

            return $this->successStatus('Booking Successfully');
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->errorStatus($exception->getMessage());
        }
    }
}
