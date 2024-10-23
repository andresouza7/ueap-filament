<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Respondent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Respondent>
 */
class RespondentFactory extends Factory
{
    protected $model = Respondent::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->name(),
            'cpf' => $this->faker->randomNumber(9) . $this->faker->randomNumber(2),
            'category_id' => Category::all()->random()->id
        ];
    }
}
