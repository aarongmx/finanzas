<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Salida;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entrada>
 */
class EntradaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cantidad' => fake()->randomFloat(2, 1, 1000),
            'precio' => fake()->randomFloat(2, 1, 1000),
            'precio_envio' => fake()->randomFloat(2, 1, 1000),
            'sucursal_id' => Sucursal::factory()->create()->id,
            'sucursal_envio_id' => Sucursal::factory()->create()->id,
            'producto_id' => Producto::factory()->create()->id,
            'salida_id' => Salida::factory()->create()->id,
        ];
    }
}
