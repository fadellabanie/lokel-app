<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Interest;
use App\Models\Passenger;
use App\Models\Experience;
use App\Models\Nationality;
use App\Models\CaptainGallery;
use App\Models\ExperienceMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Mockery\Generator\StringManipulation\Pass\Pass;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // Interest::factory(10)->create();
    // City::factory(10)->create();
    //  Nationality::factory(10)->create();
    //CaptainGallery::factory(10)->create();
    // Passenger::factory(10)->create();


    Experience::factory()->count(100)->create()->each(function ($data) {
      ExperienceMedia::factory($data)->count(5)->create([
        'experience_id' => $data->id,
      ]);
      foreach (range(1, 10) as $index) {
        $passenger =  Passenger::factory()->create();
        DB::table('experience_passenger')->insert([
          'experience_id' => $data->id,
          'passenger_id' => $passenger->id,
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      }
    });



    //ExperienceMedia::factory(10)->create();
  }
}
