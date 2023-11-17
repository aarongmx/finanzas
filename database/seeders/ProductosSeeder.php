<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['nombre' => 'POLLO ENTERO', 'categoria_id' => 1],
            ['nombre' => 'PECHUGA', 'categoria_id' => 1],
            ['nombre' => 'PIERNA / MUSLO', 'categoria_id' => 1],
            ['nombre' => 'RETAZO', 'categoria_id' => 1],
            ['nombre' => 'PATA', 'categoria_id' => 1],
            ['nombre' => 'HIGADO', 'categoria_id' => 1],
            ['nombre' => 'MOLLEJA', 'categoria_id' => 1],
            ['nombre' => 'CABEZA', 'categoria_id' => 1],
            ['nombre' => 'HR', 'categoria_id' => 1],
            ['nombre' => 'GALLINA', 'categoria_id' => 1],
            ['nombre' => 'PAVO', 'categoria_id' => 1],
            ['nombre' => 'AVE ROSTI', 'categoria_id' => 1],
            ['nombre' => 'ALA NATURAL', 'categoria_id' => 1],
            ['nombre' => 'ROJO', 'categoria_id' => 1],
            ['nombre' => 'PATA ESCALDADA', 'categoria_id' => 1],
            ['nombre' => 'HUEVO', 'categoria_id' => 1],
            ['nombre' => '(24)', 'categoria_id' => 1],
            ['nombre' => '(5895)', 'categoria_id' => 1],
            ['nombre' => 'DESPERDICIO', 'categoria_id' => 1],
        ])->each(fn($producto) => Producto::create($producto));
    }
}
