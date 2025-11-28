<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition(): array
    {
        return [
            'type' => 'fisica',
            'name' => $this->faker->name(),
            'cpf_cnpj' => $this->faker->unique()->numerify('###########'),
            'birthdate' => $this->faker->date(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'uuid' => $this->faker->uuid(),
            'lattes' => null,
            'resume' => null,
        ];
    }
}
