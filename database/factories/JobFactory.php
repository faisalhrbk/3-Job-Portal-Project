<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'user_id' => fake()->randomElement(User::pluck('id')->toArray()),
            'job_type_id' => fake()->randomElement(JobType::pluck('id')->toArray()),
            'category_id' => fake()->randomElement(Category::pluck('id')->toArray()),
            'vacancy' => rand(1, 50),
            'location' => fake()->city(),
            'description' => fake()->paragraphs(3, true),
            'experience' => fake()->numberBetween(0, 15),
            'company_name' => fake()->company(),
        ];
    }
}
