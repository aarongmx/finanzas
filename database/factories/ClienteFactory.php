<?php

namespace Database\Factories;

use App\Models\Direccion;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();

        return [
            'rfc' => fake()->regexify('[a-z0-9]{12,13}'),
            'razon_social' => $name,
            'nombre_comercial' => $name,
            'direccion_id' => Direccion::factory()->create()->id,
            'sucursal' => Sucursal::factory()->create()->id,
        ];
    }
}
