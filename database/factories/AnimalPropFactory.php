<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Animal;
use App\Models\AnimalProp;

class AnimalPropFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AnimalProp::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'animal_id' => Animal::factory(),
            'title' => $this->faker->sentence(4),
            'details' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'status' => $this->faker->boolean(),
            'display_order' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
