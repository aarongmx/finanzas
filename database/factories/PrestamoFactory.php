<?php

namespace Database\Factories;

use App\Models\Cuenta;
use App\Models\Empleado;
use App\Models\Estatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prestamo>
 */
class PrestamoFactory extends Factory
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
            'fecha_prestamo' => today(),
            'fecha_vencimiento' => today()->addDays(7),
            'cuenta_id' => Cuenta::factory()->create()->id,
            'empleado_id' => Empleado::factory()->create()->id,
            'estatus_id' => Estatus::factory()->create()->id
        ];
    }
}
