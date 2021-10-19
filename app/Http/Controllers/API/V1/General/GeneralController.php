<?php

namespace App\Http\Controllers\Api\V1\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    /**
     * upload media
     * @param  Request $request
     * @return mixed
     */
    public function upload(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'file' => 'required',
            'path' => 'required',
        ]);

        if ($validatedData->fails()) {
            return $this->errorStatus($validatedData->errors()->first());
        }

        if ($request->has('old_file')) {
            File::delete($request->old_file);
        }

        return $this->respondWithItem(upload($request->file, $request->path));
    }
}