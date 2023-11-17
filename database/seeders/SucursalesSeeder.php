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
            ['nombre' => 'TOTOI', 'direccion_id' => $dir->id],
            ['nombre' => 'AZTECAS', 'direccion_id' => $dir->id],
        ])->each(function ($sucursal) {
           Sucursal::create($sucursal);
        });
    }
}
