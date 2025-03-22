<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'submitter_id' => User::factory(),
            'name' => Str::slug(fake()->words(rand(1, 2), true)),
            'vendor' => Str::slug(fake()->words(rand(1, 2), true)),
            'display_name' => fake()->optional()->words(rand(2, 3), true),
            'description' => fake()->optional()->paragraphs(rand(1, 4), true),
            'repo_url' => 'https://github.com/laravel/laravel',
            'official' => fake()->boolean(),
            'type' => fake()->optional()->randomElement(['php', 'javascript', 'other']),
            'installation_method' => fake()->optional()->randomElement(['composer', 'npm', 'other']),
            'website' => fake()->optional()->url(),
            'languages' => fake()->optional()->randomElement(['php', 'javascript', 'other']),
            'stars_count' => fake()->numberBetween(0, 300),
            'last_synced_at' => now(),
            'meta' => null,
            'processed_at' => now(),
        ];
    }
}
