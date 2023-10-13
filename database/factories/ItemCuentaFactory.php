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
        return [
            'precio' => fake()->randomFloat(2, 1),
            'cantidad_existencia' => fake()->randomFloat(2, 1),
            'importe_existencia' => fake()->randomFloat(2, 1), 'cantidad_entrada' => fake()->randomFloat(2, 1),
            'importe_entrada' => fake()->randomFloat(2, 1), 'cantidad_salida' => fake()->randomFloat(2, 1),
            'importe_salida' => fake()->randomFloat(2, 1), 'cantidad_sobrante' => fake()->randomFloat(2, 1),
            'importe_sobrante' => fake()->randomFloat(2, 1),
            'producto_id' => Producto::factory()->create()->id,
            'cuenta_id' => Cuenta::factory()->create()->id,
        ];
    }
}
