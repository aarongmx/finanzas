<?php

namespace Database\Seeders;

use App\Models\Estatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstatusSeeder extends Seeder
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
        ])->each(fn($estatus) => Estatus::create($estatus));
    }
}
