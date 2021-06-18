<?php

namespace Database\Factories;

use App\Models\Integration;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IntegrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Integration::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'marketplace' => $this->faker->randomElement(["HepsiBuarada", "Trendyol", "GittiGidiyor", "n11"]),
            'username' => $this->faker->userName,
            'password' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'user_id' => function() {
                return User::all()->random()->id;
            }
        ];
    }
}
