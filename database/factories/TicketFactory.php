<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        $statusOptions = ['pendente', 'aprovado', 'rejeitado'];

        return [
            'user_id'       => User::inRandomOrder()->first()->id,
            'file_id'       => $this->faker->uuid,
            'file_path'     => $this->faker->url,
            'status'        => $this->faker->randomElement($statusOptions),
            'evaluador_id'  => User::inRandomOrder()->first()->id,
            'evaluated_at'  => $this->faker->dateTimeBetween('-1 year', 'now'),
            'month'         => $this->faker->numberBetween(1, 12),
            'year'          => $this->faker->numberBetween(now()->year - 1, now()->year),
        ];
    }

    /**
     * Define um ticket aprovado
     */
    public function aprovado()
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'aprovado',
            'evaluated_at' => now(),
        ]);
    }

    /**
     * Define um ticket pendente
     */
    public function pendente()
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'pendente',
            'evaluated_at' => null,
        ]);
    }

    /**
     * Define um ticket rejeitado
     */
    public function rejeitado()
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'rejeitado',
            'evaluated_at' => now(),
        ]);
    }
}
