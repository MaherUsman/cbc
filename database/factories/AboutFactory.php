<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\About;

class AboutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = About::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'slink' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'details' => $this->faker->text(),
            'image' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'display_order' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->boolean(),
        ];
    }
}
