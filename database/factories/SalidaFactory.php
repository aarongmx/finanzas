<?php

namespace Database\Factories;

use App\Models\Cuenta;
use App\Models\Producto;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salida>
 */
class SalidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $monto = fake()->randomFloat(2, 1);
        $cantidad = fake()->randomFloat(2, 1);
        $total = $monto * $cantidad;
        return [
            'cantidad' => $cantidad,
            'monto' => $monto,
            'total' => $total,
            'sucursal_id' => Sucursal::factory()->create(),
            'producto_id' => Producto::factory()->create(),
            'cuenta_id' => Cuenta::factory()->create(),
        ];
    }
}
