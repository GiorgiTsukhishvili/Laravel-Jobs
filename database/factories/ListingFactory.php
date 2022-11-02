<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'tags' => fake()->word(),
            'company' => fake()->name(),
            'location' => fake()->address(),
            'email' => fake()->email(),   
            'website' => fake()->domainName(),
            'description' => fake()->paragraph()
        ];
    }
}
