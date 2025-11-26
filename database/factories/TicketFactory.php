<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'file_id' => null,
            'file_path' => null,
            'month' => $this->faker->numberBetween(1, 12),
            'year' => $this->faker->numberBetween(2020, 2030),
            'status' => 'pendente',
            'evaluador_id' => null,
            'evaluated_at' => null,
            'user_notes' => null,
            'evaluator_notes' => null,
        ];
    }

    /**
     * Estado para ticket aprovado.
     */
    public function aprovado(): self
    {
        return $this->state(fn () => [
            'status' => 'aprovado',
            'evaluated_at' => now(),
        ]);
    }

    /**
     * Estado para ticket rejeitado.
     */
    public function rejeitado(): self
    {
        return $this->state(fn () => [
            'status' => 'rejeitado',
            'evaluated_at' => now(),
        ]);
    }
}
