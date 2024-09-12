<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ContactUs;

class ContactUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactUs::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'email' => $this->faker->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'subject' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'details' => $this->faker->text(),
        ];
    }
}
