<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sugestao>
 */
class SugestaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(5),
            'youtube_id' => $this->faker->unique()->regexify('[A-Za-z0-9]{11}'),
            'thumb' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['pendente', 'aprovada', 'rejeitada']),
        ];
    }
}
