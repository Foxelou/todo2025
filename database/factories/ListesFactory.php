<?php

namespace Database\Factories;

use App\Models\Listes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Listes>
 */
class ListesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle' => fake()->words(2, true), // par ex. "Maison", "Bureau perso"
        ];
    }
}
