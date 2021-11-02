<?php

namespace App\Http\Controllers\Api\V1\Captains\Histories;

use App\Models\Experience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Captains\Histories\HistoryCollection;
use App\Http\Resources\Captains\Histories\HistoryLargeResource;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //  dd(Auth::id());
        $experience = Experience::with(['passengers'])
            ->without(['medias'])
            ->mine()
            ->accept()
            ->when($request->city_id, function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            })->when($request->country_id, function ($q) use ($request) {
                $q->where('country_id', $request->country_id);
            })->when($request->price_from && $request->price_to, function ($q) use ($request) {
                $q->whereBetween('price', [$request->price_from, $request->price_to]);
            })
            ->orderByDESC('id')
            ->paginate();

        return new HistoryCollection($experience);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $experience = Experience::whereId($id)->with(['passengers'])
            ->without(['medias'])
            ->mine()
            ->accept()->first();

        if (!$experience) return $this->errorNotFound();

        return $this->respondWithItem(new HistoryLargeResource($experience));
    }
}
