<?php

namespace Database\Factories;

use App\Models\EstadoCuenta;
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
            'efectivo_pollo' => fake()->randomFloat(2, 1),
            'efectivo_marinado' => fake()->randomFloat(2, 1),
            'efectivo_total' => fake()->randomFloat(2, 1),
            'saldo' => fake()->randomFloat(2, 1),
            'fecha_captura' => now(),
            'fecha_venta' => now()->subDay(),
            'sucursal_id' => Sucursal::factory()->create()->id,
            'estado_cuenta_id' => EstadoCuenta::factory()->create()->id,
        ];
    }
}
