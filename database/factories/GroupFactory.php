<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'description' => $this->faker->sentence(),
            'ramal' => null,
            'group_parent_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'uuid' => $this->faker->uuid(),
        ];
    }
}
