<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement([
            'consu_resolution',
            'consu_ata',
            'orcamento',
            'portaria',
            'transparency_bid_document',
            'calendar_occurrence',
        ]);

        return [
            'uuid'        => $this->faker->uuid(),
            'type'        => $type,
            'name'       => $this->faker->sentence(3),
            'description' => $this->faker->sentence(7),
            'year'        => $this->faker->year(),
            'status'      => $this->faker->randomElement(['draft', 'published']),
            'metadata'    => $this->fakeMetadata($type),
            'user_created_id' => 1, // or User::factory()
            'user_updated_id' => null,
        ];
    }

    protected function fakeMetadata(string $type): array
    {
        return match ($type) {
            'consu_resolution' => [
                'number' => $this->faker->randomNumber(),
            ],
            'consu_ata' => [
                'issuer'        => $this->faker->company(),
                'issuance_date' => $this->faker->date(),
            ],
            'orcamento' => [
                'month'       => $this->faker->monthName(),
                'value'       => $this->faker->randomFloat(2, 1000, 50000),
                'observation' => $this->faker->sentence(),
            ],
            'portaria' => [
                'number' => $this->faker->bothify('###/####'),
                'subject' => $this->faker->sentence(),
                'origin' => $this->faker->company(),
            ],
            'transparency_bid_document' => [
                'number' => $this->faker->bothify('###/####'),
                'transparency_bid_id' => $this->faker->randomNumber(),
            ],
            'calendar_occurrence' => [
                'start_date'  => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'end_date'    => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            ],
            default => [],
        };
    }
}
