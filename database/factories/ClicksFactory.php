<?php

namespace Database\Factories;

use App\Models\Clicks;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClicksFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clicks::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'link_id'=> $this->faker->randomNumber(),
        ];
    }
}
