<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AboutUs;

class AboutUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AboutUs::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'p1' => $this->faker->text(),
            'p2' => $this->faker->text(),
            'image' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'status' => $this->faker->boolean(),
        ];
    }
}
