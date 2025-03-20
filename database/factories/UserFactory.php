<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->unique()->userName(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'avatar' => null,
            'bio' => fake()->optional()->sentence(),
            'website' => fake()->optional()->url(),
            'status' => fake()->optional()->sentence(),
            'auth_provider' => 'github',
            'auth_token' => null,
            'auth_type' => 'user',
            'laravel_employee' => fake()->boolean(),
            'unclaimed' => fake()->boolean(),
            'claimed_at' => fake()->optional()->dateTime(),
            'meta' => null,
            'remember_token' => Str::random(10),
        ];
    }

    public function unclaimed(): static
    {
        return $this->state(fn (array $attributes) => [
            'unclaimed' => true,
        ]);
    }

    public function claimed(): static
    {
        return $this->state(fn (array $attributes) => [
            'unclaimed' => false,
            'claimed_at' => now(),
        ]);
    }
}
