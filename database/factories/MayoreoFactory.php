<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mayoreo>
 */
class MayoreoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $precio = fake()->randomFloat(2, 100, 700);
        $cantidad = fake()->randomFloat(2, 100, 700);

        return [
            'sucursal_id' => Sucursal::factory()->create()->id,
            'producto_id' => Producto::factory()->create()->id,
            'precio' => $precio,
            'cantidad' => $cantidad,
            'total' => $precio * $cantidad,
            'fecha_venta' => today()
        ];
    }
}
