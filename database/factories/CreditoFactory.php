<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\Estatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Credito>
 */
class CreditoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $monto = fake()->randomFloat(2, 1, 10000);

        return [
            'monto' => $monto,
            'saldo' => $monto,
            'fecha_credito' => today(),
            'fecha_vencimiento' => today()->addDays(7),
            'cuenta_id' => Cuenta::factory()->create()->id,
            'cliente_id' => Cliente::factory()->create()->id,
            'estatus_id' => Estatus::factory()->create()->id,
        ];
    }
}
