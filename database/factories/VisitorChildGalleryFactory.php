<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\VisitorChildGallery;
use App\Models\VisitorGallery;

class VisitorChildGalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VisitorChildGallery::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'visitor_gallery_id' => VisitorGallery::factory(),
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug(),
            'image' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'status' => $this->faker->boolean(),
        ];
    }
}
