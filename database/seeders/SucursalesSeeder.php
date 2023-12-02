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
            ['id' => 5, 'nombre' => 'COPILCO', 'direccion_id' => $dir->id],
            ['id' => 7, 'nombre' => 'TOTOI', 'direccion_id' => $dir->id],
            ['id' => 6, 'nombre' => 'ESCUINAPA', 'direccion_id' => $dir->id],
            ['id' => 8, 'nombre' => 'TEPETLAPA', 'direccion_id' => $dir->id],
            ['id' => 9, 'nombre' => 'OPICHEN', 'direccion_id' => $dir->id],
            ['id' => 10, 'nombre' => 'TETIZ', 'direccion_id' => $dir->id],
            ['id' => 11, 'nombre' => 'GRUPO DZ', 'direccion_id' => $dir->id],
            ['id' => 12, 'nombre' => 'GRUPO COMERCIAL', 'direccion_id' => $dir->id],
            ['id' => 299, 'nombre' => 'SRA CASTILLO', 'direccion_id' => $dir->id],
            ['id' => 300, 'nombre' => 'LUZ', 'direccion_id' => $dir->id],
            ['id' => 301, 'nombre' => 'D1', 'direccion_id' => $dir->id],
            ['id' => 302, 'nombre' => 'RAMÓN', 'direccion_id' => $dir->id],
            ['id' => 303, 'nombre' => 'D2', 'direccion_id' => $dir->id],
            ['id' => 309, 'nombre' => 'D3', 'direccion_id' => $dir->id],
            ['id' => 13, 'nombre' => 'LAS ROSAS', 'direccion_id' => $dir->id],
            ['id' => 315, 'nombre' => 'CARNE', 'direccion_id' => $dir->id],
            ['id' => 14, 'nombre' => 'EL CRISTO - FAMSA', 'direccion_id' => $dir->id],
            ['id' => 15, 'nombre' => 'MH', 'direccion_id' => $dir->id],
            ['id' => 16, 'nombre' => 'BODEGA', 'direccion_id' => $dir->id],
            ['id' => 316, 'nombre' => 'SEÑOR LADRON', 'direccion_id' => $dir->id],
            ['id' => 322, 'nombre' => 'TEPETLAPA ML', 'direccion_id' => $dir->id],
            ['id' => 323, 'nombre' => 'D4', 'direccion_id' => $dir->id],
            ['id' => 329, 'nombre' => 'PEESCDITOS 2', 'direccion_id' => $dir->id],
            ['id' => 328, 'nombre' => 'PESCADITOS', 'direccion_id' => $dir->id],
            ['id' => 332, 'nombre' => 'LA CANDE', 'direccion_id' => $dir->id],
            ['id' => 333, 'nombre' => 'SOLUCION ALIMENTARIA', 'direccion_id' => $dir->id],
            ['id' => 334, 'nombre' => 'ROSAS 1', 'direccion_id' => $dir->id],
            ['id' => 331, 'nombre' => 'TLALCOLIGIA', 'direccion_id' => $dir->id],
            ['id' => 18, 'nombre' => 'BODEGUITA', 'direccion_id' => $dir->id],
        ])->each(function ($sucursal) {
            Sucursal::create($sucursal);
        });
    }
}
