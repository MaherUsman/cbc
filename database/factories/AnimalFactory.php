<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Animal;

class AnimalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Animal::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug(),
            'image' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'details' => $this->faker->text(),
            'show_on_top_bar' => $this->faker->boolean(),
            'status' => $this->faker->boolean(),
            'display_order' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
