<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Person;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        // Criar dependências obrigatórias
        $person = Person::factory()->create();
        $group = Group::factory()->create();

        return [
            'user_type' => 'default',
            'person_id' => $person->id,
            'group_id' => $group->id,
            'login' => $this->faker->userName(),
            'password' => bcrypt('password'),
            'ramal' => null,
            'enrollment' => null,
            'effective_role_id' => null,
            'commissioned_role_id' => null,
            'effective_role_desc' => null,
            'commissioned_role_desc' => null,
            'use_protocol' => null,
            'has_commissioned' => null,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'uuid' => $this->faker->uuid(),
            'email' => $this->faker->safeEmail(),
            'current_team_id' => null,
            'profile_photo_path' => null,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
            'gauth_id' => null,
            'gauth_type' => null,
            'skip_tutorial' => false,
        ];
    }
}
