<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Team;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'designation' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'image' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'details' => $this->faker->text(),
        ];
    }
}
