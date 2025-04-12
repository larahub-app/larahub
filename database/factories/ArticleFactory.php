<?php

namespace Database\Factories;

use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // models that can have articles
        $models = [
            Package::class,
        ];

        // Get a random model from the array
        $model = fake()->randomElement($models);

        // get the morph alias of the model
        $type = Relation::getMorphAlias($model::class);

        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(),
            'url' => fake()->url(),
            'articleable_id' => $model,
            'articleable_type' => $type,
            'description' => fake()->optional()->paragraph(),
            'approved' => $approved = fake()->boolean(),
            'approved_at' => $approved ? fake()->dateTime() : null,
            'approved_by' => $approved ? User::factory() : null,
        ];
    }

    public function pending(): self
    {
        return $this->state(fn (array $attributes) => [
            'approved' => false,
            'approved_at' => null,
            'approved_by' => null,
        ]);
    }

    public function approved(?User $user = null): self
    {
        return $this->state(fn (array $attributes) => [
            'approved' => true,
            'approved_at' => fake()->dateTime(),
            'approved_by' => $user ? $user->id : User::factory(),
        ]);
    }

    public function forModel(Model $model): self
    {
        $type = Relation::getMorphAlias($model::class);

        return $this->state(fn (array $attributes) => [
            'articleable_id' => $model->id,
            'articleable_type' => $type,
        ]);
    }
}
