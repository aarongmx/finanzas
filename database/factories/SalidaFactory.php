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
        $precio = fake()->randomFloat(2, 1);
        $cantidad = fake()->randomFloat(2, 1);
        $total = $precio * $cantidad;

        return [
            'cantidad' => $cantidad,
            'precio' => $precio,
            'total' => $total,
            'producto_id' => Producto::factory()->create(),
            'cuenta_id' => Cuenta::factory()->create(),
            'sucursal_destino_id' => Sucursal::factory()->create(),
        ];
    }
}
