<?php

namespace Database\Factories;


use App\Models\Experience;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Experience::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city_id'=>$this->faker->randomElement([1,2,3,4,5]),
            'country_id'=>$this->faker->randomElement([1,2,3,4,5]),
            'captain_id'=>$this->faker->randomElement([1,2,3,4,5]),
            'code' => generateRandomCode('EXP'),
            'icon' =>  $this->faker->imageUrl(),
            'title' => $this->faker->sentence,
            'description' =>  $this->faker->sentence,
            'thumbnail' =>  $this->faker->sentence,
            'duration_type' => 1,
            'duration' =>  $this->faker->randomNumber(),
            'price' => $this->faker->randomNumber(3),
            'included' =>  $this->faker->sentence,
            'expect' =>  $this->faker->sentence,
            'faqs' =>  $this->faker->sentence,
            'pick_up_address' => $this->faker->address,
            'pick_up_lat' => $this->faker->latitude,
            'pick_up_lng' => $this->faker->longitude,
            'drop_of_address' =>  $this->faker->address,
            'drop_of_lat' =>  $this->faker->latitude,
            'drop_of_lng' =>  $this->faker->longitude,
            'meals' => true,
            'status' => Experience::PENDING,
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
