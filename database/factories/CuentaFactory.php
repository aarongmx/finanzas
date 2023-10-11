<?php

namespace Database\Factories;

use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cuenta>
 */
class CuentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'efectivo' => fake()->randomFloat(2, 1),
            'a_cuenta' => fake()->randomFloat(2, 1),
            'sucursal_id' => Sucursal::factory()->create()->id,
        ];
    }
}
