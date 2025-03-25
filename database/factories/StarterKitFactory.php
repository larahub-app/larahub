<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StarterKit>
 */
class StarterKitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'display_name' => fake()->words(rand(2, 3), true),
            'user_id' => User::factory(),
            'submitter_id' => User::factory(),
            'name' => Str::slug(fake()->words(rand(1, 2), true)),
            'vendor' => Str::slug(fake()->words(rand(1, 2), true)),
            'repo_url' => 'https://github.com/laravel/laravel',
            'official' => fake()->boolean(),
            'parsed_readme' => fake()->optional()->paragraphs(rand(1, 4), true),
            'readme_last_parsed_at' => now(),
            'website' => fake()->optional()->url(),
            'languages' => fake()->optional()->randomElement(['php', 'javascript', 'other']),
            'stars_count' => fake()->numberBetween(0, 300),
            'last_synced_at' => now(),
            'default_branch' => fake()->optional()->randomElement(['main', 'master', 'develop']),
            'meta' => null,
            'processed_at' => now(),
            'templating_engine' => fake()->randomElement(['livewire', 'blade', 'react', 'vue', 'svelte', 'other']),
            'css_framework' => fake()->randomElement(['tailwind', 'bootstrap', 'other']),
            'inertia' => fake()->boolean(),
            'panel_builder' => fake()->boolean(),
            'authentication' => fake()->boolean(),            
        ];
    }
}
