<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Link::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'link'=> $this->faker->randomElement(['https://ya.ru/','https://mail.ru/','https://google.com/']),
            'alias' => $this->faker->regexify('[a-z0-9]{10}'),
            'user_id' =>  $this->faker->randomNumber(),
        ];
    }
}
