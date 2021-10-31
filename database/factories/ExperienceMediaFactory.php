<?php

namespace Database\Factories;

use App\Models\Experience;
use App\Models\ExperienceMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceMediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExperienceMedia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       // dd($this->data);
        return [
           // 'experience_id' => $this->data->id,
            'image' => $this->faker->imageUrl(),            
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
