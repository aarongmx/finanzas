<?php

namespace Database\Seeders;

use App\Models\Direccion;
use App\Models\Sucursal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SucursalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dir = Direccion::factory()->create();
        collect([
            ['nombre' => 'COPILCO', 'direccion_id' => $dir->id],
            ['nombre' => 'TOTOI', 'direccion_id' => $dir->id],
            ['nombre' => 'ESCUINAPA', 'direccion_id' => $dir->id],
            ['nombre' => 'TEPETLAPA', 'direccion_id' => $dir->id],
            ['nombre' => 'OPICHEN', 'direccion_id' => $dir->id],
            ['nombre' => 'TETIZ', 'direccion_id' => $dir->id],
            ['nombre' => 'GRUPO DZ', 'direccion_id' => $dir->id],
            ['nombre' => 'GRUPO COMERCIAL', 'direccion_id' => $dir->id],
            ['nombre' => 'SRA CASTILLO', 'direccion_id' => $dir->id],
            ['nombre' => 'LUZ', 'direccion_id' => $dir->id],
            ['nombre' => 'RAMÓN', 'direccion_id' => $dir->id],
            ['nombre' => 'LAS ROSAS', 'direccion_id' => $dir->id],
            ['nombre' => 'CARNE', 'direccion_id' => $dir->id],
            ['nombre' => 'EL CRISTO - FAMSA', 'direccion_id' => $dir->id],
            ['nombre' => 'MH', 'direccion_id' => $dir->id],
            ['nombre' => 'BODEGA', 'direccion_id' => $dir->id],
            ['nombre' => 'SEÑOR LADRON', 'direccion_id' => $dir->id],
            ['nombre' => 'TEPETLAPA ML', 'direccion_id' => $dir->id],
            ['nombre' => 'PEESCDITOS 2', 'direccion_id' => $dir->id],
            ['nombre' => 'PESCADITOS', 'direccion_id' => $dir->id],
            ['nombre' => 'LA CANDE', 'direccion_id' => $dir->id],
            ['nombre' => 'SOLUCION ALIMENTARIA', 'direccion_id' => $dir->id],
            ['nombre' => 'ROSAS 1', 'direccion_id' => $dir->id],
            ['nombre' => 'TLALCOLIGIA', 'direccion_id' => $dir->id],
            ['nombre' => 'BODEGUITA', 'direccion_id' => $dir->id],
        ])->each(function ($sucursal) {
            Sucursal::create($sucursal);
        });
    }
}
