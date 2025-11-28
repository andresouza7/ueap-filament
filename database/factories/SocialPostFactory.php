<?php

namespace Database\Factories;

use App\Models\SocialPost;
use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SocialPostFactory extends Factory
{
    protected $model = SocialPost::class;

    public function definition(): array
    {
        return [
            'group_id' => Group::factory(),
            'user_id' => User::factory(),
            'text' => $this->faker->paragraph(3),
            'uuid' => Str::uuid(),
        ];
    }
}
