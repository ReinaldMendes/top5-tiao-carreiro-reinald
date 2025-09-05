<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Musica>
 */
class MusicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'visualizacoes' => $this->faker->numberBetween(100000, 10000000),
            'youtube_id' => $this->faker->unique()->regexify('[A-Za-z0-9]{11}'),
            'thumb' => $this->faker->imageUrl(),
        ];
    }
}
