<?php

namespace App\Http\Services;

use App\Models\Experience;
use Illuminate\Support\Facades\DB;

class ExperienceService
{

    /**
     * Create new row.
     * @param  array $data 
     * @return mixed
     */
    public static function create($data)
    {
        DB::beginTransaction();

        $response['success'] = true;

        try {
            $experience = Experience::create([
                'city_id' => $data['city_id'],
                'country_id' => $data['country_id'],
                'captain_id' => $data['captain_id'],
                'icon' => $data['icon'],
                'title' => $data['title'],
                'code' => generateRandomCode('EXP'),
                'description' => $data['description'],
                'thumbnail' => $data['thumbnail'],
                'duration_type' => $data['duration_type'],
                'duration' => $data['duration'],
                'price' => $data['price'],
                'included' => $data['included'],
                'expect' => $data['expect'],
                'faqs' => $data['faqs'],
                'pick_up_address' => $data['pick_up_address'],
                'pick_up_lat' => $data['pick_up_lat'],
                'pick_up_lng' => $data['pick_up_lat'],
                'dropp_of_address' => $data['dropp_of_address'],
                'dropp_of_lat' => $data['dropp_of_lat'],
                'dropp_of_lng' => $data['dropp_of_lng'],
                'meals' => $data['meals'],
                'status' => Experience::PENDING,
            ]);

            foreach ($data['images'] as $image) {
                DB::table('experience_media')->insert([
                    'experience_id' => $experience->id,
                    'image' => $image,
                    'created_at' => now(),
                ]);
            }
            DB::commit();
            return $response;
        } catch (\Exception $exception) {
            DB::rollback();
            $response['success'] = false;
            $response['message'] = $exception->getMessage();
            return $response;
        }
    }

    /**
     * update row.
     * @param  array $data 
     * @return mixed
     */
    public static function update($data, $experience)
    {
        DB::beginTransaction();

        $response['success'] = true;

        try {
            $experience->update([
                'city_id' => $data['city_id'],
                'country_id' => $data['country_id'],
                'captain_id' => $data['captain_id'],
                'icon' => $data['icon'],
                'title' => $data['title'],
                'code' => generateRandomCode('EXP'),
                'description' => $data['description'],
                'thumbnail' => $data['thumbnail'],
                'duration_type' => $data['duration_type'],
                'duration' => $data['duration'],
                'price' => $data['price'],
                'included' => $data['included'],
                'expect' => $data['expect'],
                'faqs' => $data['faqs'],
                'pick_up_address' => $data['pick_up_address'],
                'pick_up_lat' => $data['pick_up_lat'],
                'pick_up_lng' => $data['pick_up_lat'],
                'dropp_of_address' => $data['dropp_of_address'],
                'dropp_of_lat' => $data['dropp_of_lat'],
                'dropp_of_lng' => $data['dropp_of_lng'],
                'meals' => $data['meals'],
                'status' => Experience::PENDING,
            ]);
            if ($data['images']) {
                foreach ($data['images'] as $image) {
                    DB::table('experience_media')->insert([
                        'experience_id' => $experience->id,
                        'image' => $image,
                        'created_at' => now(),
                    ]);
                }
            }
            DB::commit();
            return $response;
        } catch (\Exception $exception) {
            DB::rollback();
            $response['success'] = false;
            $response['message'] = $exception->getMessage();
            return $response;
        }
    }
}
