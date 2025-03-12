<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Citation>
 */
class CitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            $contenu = $this->faker->sentence($this->faker->numberBetween(5, 15));

            return [
                'contenu' => $contenu,
                'auteur' => $this->faker->name(),
                'popularite' => $this->faker->numberBetween(0, 1000),
                'nbr_mots' => str_word_count($contenu),
                'url_image' => $this->faker->optional()->imageUrl(640, 480, 'quotes'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
    }
}
