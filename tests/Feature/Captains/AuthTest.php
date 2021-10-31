<?php

namespace Tests\Feature\Captains;

use Tests\TestCase;
use App\Models\City;
use App\Models\Captain;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    /** @test */
    public function captain_can_register()
    {
        // $data = Captain::factory();
        // dd($data);
        // dd(Hash::make('1').$this->faker->unique()->safeEmail);
        $data = Captain::create([
            'city_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'country_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'nationality_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'country_code' =>  $this->faker->countryCode,
            'country_of_residence' => $this->faker->countryCode,
            'mobile' => '0115265' . $this->faker->numerify('#####'),
            'password' => Hash::make('12345678'),
            'code' => generateRandomCode('CPT'),
            'avatar' =>  $this->faker->imageUrl(),
            'birthday' => $this->faker->date($format = 'Y-m-d'),
            'gender' =>  $this->faker->randomElement([1, 2, 3]),
            'front_personal' => $this->faker->imageUrl(),
            'back_personal' => $this->faker->imageUrl(),
            'address' => $this->faker->address,
            'number_of_trips' => $this->faker->randomNumber(),
            'cv' => $this->faker->imageUrl(),
            'rate' => $this->faker->randomElement([1.5, 2.2, 4.2, 3.5, 5.0, 2.1, 4.8, 2.9]),
            'drive_license' => $this->faker->randomElement([true, false]),
            'is_smoker' => $this->faker->randomElement([true, false]),
            'languages' => 'arabic,english',
            'bio' => $this->faker->sentence,
            'car_model' => $this->faker->word,
            'status' => true
        ])->toArray();

        $response = $this->post('/api/v1/captains/register', $data);
        // dd($response);
        var_dump($response);

        //$this->withoutExceptionHandling();

        //  $response->assertStatus(201);
    }
}
