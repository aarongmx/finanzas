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
            ['nombre' => 'HR', 'categoria_id' => 1,],
            ['nombre' => 'GALLINA', 'categoria_id' => 1,],
            ['nombre' => 'POLLO ENTERO', 'categoria_id' => 1,],
            ['nombre' => 'PECHUGA', 'categoria_id' => 1,],
            ['nombre' => 'PIERNA / MUSLO', 'categoria_id' => 1,],
            ['nombre' => 'RETAZO', 'categoria_id' => 1,],
            ['nombre' => 'PATA', 'categoria_id' => 1,],
            ['nombre' => 'HIGADO', 'categoria_id' => 1,],
            ['nombre' => 'MOLLEJA', 'categoria_id' => 1,],
            ['nombre' => 'CABEZA', 'categoria_id' => 1,],
            ['nombre' => 'AVI ROSTI', 'categoria_id' => 1,],
            ['nombre' => 'TENDER', 'categoria_id' => 2,],
            ['nombre' => 'NUGGETS', 'categoria_id' => 2,],
            ['nombre' => 'ALITA PICOSITA', 'categoria_id' => 2,],
            ['nombre' => 'TIRA DE ANTOJO', 'categoria_id' => 2,],
            ['nombre' => 'NUGGET ESTRELLA', 'categoria_id' => 2,],
            ['nombre' => 'PALOMITA DE PECHIGA', 'categoria_id' => 2,],
            ['nombre' => 'HAMBURGUESAS', 'categoria_id' => 2,],
            ['nombre' => 'MUSLO MARINAD', 'categoria_id' => 2,],
            ['nombre' => 'PAPA CATERPAC', 'categoria_id' => 2,],
            ['nombre' => 'PAPA IDAHO', 'categoria_id' => 2,],
            ['nombre' => 'PAPA GAJO', 'categoria_id' => 2,],
            ['nombre' => 'PAPA ESPIRAL', 'categoria_id' => 2,],
            ['nombre' => 'HUEVO ROJO', 'categoria_id' => 2,],
            ['nombre' => 'HUEVO BLANCO', 'categoria_id' => 2,],
            ['nombre' => 'MOLE', 'categoria_id' => 2,],
            ['nombre' => 'PAN MOLIDO', 'categoria_id' => 2,],
            ['nombre' => 'PAN SAZON', 'categoria_id' => 2,],
            ['nombre' => 'ARTISANO', 'categoria_id' => 2,],
            ['nombre' => 'GLOBAL', 'categoria_id' => 2,],
        ])->each(fn ($producto) => Producto::create($producto));
    }
}
