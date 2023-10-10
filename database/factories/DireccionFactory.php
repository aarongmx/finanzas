<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Direccion>
 */
class DireccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo_postal' => fake()->regexify('[0-9]{5}'),
            'colonia' => fake()->city(),
            'estado' => fake()->city(),
            'numero_interior' => fake()->regexify('[0-9a-zA-Z-]{2,4}'),
            'numero_exterior' => fake()->regexify('[0-9a-zA-Z-]{2,4}'),
            'calle' => fake()->address(),
        ];
    }
}
