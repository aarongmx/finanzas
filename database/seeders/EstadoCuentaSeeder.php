<?php

namespace Database\Seeders;

use App\Models\EstadoCuenta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoCuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['nombre' => 'PENDIENTE'],
            ['nombre' => 'PAGO PARCIAL'],
            ['nombre' => 'PAGADO'],
        ])->each(fn($estado) => EstadoCuenta::create($estado));
    }
}
