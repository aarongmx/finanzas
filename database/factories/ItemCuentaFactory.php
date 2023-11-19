<?php

namespace Database\Factories;

use App\Models\Cuenta;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemCuenta>
 */
class ItemCuentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $precio = fake()->randomFloat(2, 1);
        $cantidadExistencia = fake()->randomFloat(2, 1);
        $cantidadEntrada = fake()->randomFloat(2, 1);
        $cantidadSalida = fake()->randomFloat(2, 1);
        $cantidadSobrante = fake()->randomFloat(2, 1);

        return [
            'precio' => $precio,
            'cantidad_existencia' => $cantidadExistencia,
            'importe_existencia' => $precio * $cantidadExistencia,
            'cantidad_entrada' => $cantidadEntrada,
            'importe_entrada' => $precio * $cantidadExistencia,
            'cantidad_salida' => $cantidadSalida,
            'importe_salida' => $precio * $cantidadSalida,
            'cantidad_sobrante' => $cantidadSobrante,
            'importe_sobrante' => $precio * $cantidadSobrante,
            'producto_id' => Producto::factory()->create()->id,
            'cuenta_id' => Cuenta::factory()->create()->id,
        ];
    }
}
