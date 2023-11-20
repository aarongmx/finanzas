<?php

namespace Database\Factories;

use App\Models\Cuenta;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GastoFijo>
 */
class GastoFijoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'precio' => fake()->randomFloat(2, 1),
            'concepto' => fake()->word(),
            'sucursal_id' => Sucursal::factory()->create()->id,
        ];
    }
}
