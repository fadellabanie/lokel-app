<?php

namespace Database\Factories;

use App\Models\Passenger;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Passenger::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city_id'=>$this->faker->randomElement([1,2,3,4.5]),
            'country_id'=>$this->faker->randomElement([1,2,3,4.5]),
            'nationality_id'=>$this->faker->randomElement([1,2,3,4.5]),
            'full_name'=>$this->faker->name,
            'email'=> $this->faker->unique()->safeEmail,
            'country_code'=>  $this->faker->countryCode,
            'country_of_residence'=> $this->faker->countryCode,
            'mobile'=> '0115265'.$this->faker->numerify('#####'),
            'password'=> Hash::make('12345678'),
            'code'=> generateRandomCode('PSN'),
            'avatar'=>  $this->faker->imageUrl(),
            'birthday'=> $this->faker->date($format = 'Y-m-d'),
            'gender'=>  $this->faker->randomElement([1,2,3]),
            'rate'=> $this->faker->randomElement([1.5,2.2,4.2,3.5,5.0,2.1,4.8,2.9]),
            'status'=> true
           // 'skills'=> 'play,chess',
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
