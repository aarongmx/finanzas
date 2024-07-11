<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['nombre' => '*POLLO ENTERO', 'categoria_id' => 1],
            ['nombre' => '*PECHUGA', 'categoria_id' => 1],
            ['nombre' => '*PIERNA/MULOS', 'categoria_id' => 1],
            ['nombre' => '*PIERNA SOLA', 'categoria_id' => 1],
            ['nombre' => '*MUSLO', 'categoria_id' => 1],
            ['nombre' => '*RETAZO', 'categoria_id' => 1],
            ['nombre' => '*PATA', 'categoria_id' => 1],
            ['nombre' => '*HÍGADO', 'categoria_id' => 1],
            ['nombre' => '*MOLLEJA', 'categoria_id' => 1],
            ['nombre' => '*CABEZA', 'categoria_id' => 1],
            ['nombre' => '*H/R', 'categoria_id' => 1],
            ['nombre' => '*GALLINA', 'categoria_id' => 1],
            ['nombre' => '*ALA NATURAL', 'categoria_id' => 1],
            ['nombre' => '*HUEVO BLANCO', 'categoria_id' => 1],
            ['nombre' => 'HUEVO ROJO', 'categoria_id' => 1],
            ['nombre' => 'PATA PELADA', 'categoria_id' => 1],
            ['nombre' => 'PM DE TOTE', 'categoria_id' => 1],
            ['nombre' => 'PECHUGA DE TOTE', 'categoria_id' => 1],
            ['nombre' => 'ALA MARINADA', 'categoria_id' => 1],
            ['nombre' => 'PECHUGA CONELADA', 'categoria_id' => 1],
            ['nombre' => 'P/M DESHUESADA', 'categoria_id' => 1],
            ['nombre' => 'LONGANIZA', 'categoria_id' => 1],
            ['nombre' => 'MOLLEJA BLANCA', 'categoria_id' => 1],
            ['nombre' => 'HÍGADO AVI', 'categoria_id' => 1],
            ['nombre' => 'TENDER', 'categoria_id' => 2],
            ['nombre' => 'NUGGET', 'categoria_id' => 2],
            ['nombre' => 'ALITA PICOSITA', 'categoria_id' => 2],
            ['nombre' => 'TIRAS DE ANTOJO', 'categoria_id' => 2],
            ['nombre' => 'NUGGET ESTRELLA', 'categoria_id' => 2],
            ['nombre' => 'PALOMITA DE PECH.', 'categoria_id' => 2],
            ['nombre' => 'HAMBURGUESA DE POLLO', 'categoria_id' => 2],
            ['nombre' => 'PAPA CATERPACK', 'categoria_id' => 2],
            ['nombre' => 'PAPA IDAHO', 'categoria_id' => 2],
            ['nombre' => 'PAPA GAJO', 'categoria_id' => 2],
            ['nombre' => 'PAPA ESPIRAL', 'categoria_id' => 2],
            ['nombre' => 'MOLE', 'categoria_id' => 2],
            ['nombre' => 'BONELESS', 'categoria_id' => 2],
            ['nombre' => 'PAPA CARITA', 'categoria_id' => 2],
            ['nombre' => 'HAMBURGUESA DE SIRLOIN', 'categoria_id' => 2],
            ['nombre' => 'AROS DE CEBOLLA', 'categoria_id' => 2],
            ['nombre' => 'MARINADOR EN POLVO', 'categoria_id' => 2],
            ['nombre' => 'HAMBURGUESA DE ARRACHERA', 'categoria_id' => 2],
            ['nombre' => 'PAPA CÁSCARA', 'categoria_id' => 2],
            ['nombre' => 'TILAPIA', 'categoria_id' => 2],
            ['nombre' => 'SALMÓN', 'categoria_id' => 2],
            ['nombre' => 'ARRACHERA', 'categoria_id' => 2],
            ['nombre' => 'DEDOS DE QUESO', 'categoria_id' => 2],
            ['nombre' => 'PIERNA DE PAVO AHUMADA', 'categoria_id' => 2],
            ['nombre' => 'POLLO NAVIDEÑO', 'categoria_id' => 2],
            ['nombre' => 'PAVO NATURAL', 'categoria_id' => 2],
            ['nombre' => 'PAVO AHUMADO', 'categoria_id' => 2],
            ['nombre' => 'TITAS GRILL', 'categoria_id' => 2],
            ['nombre' => 'MC NUGGET', 'categoria_id' => 2],
            ['nombre' => 'PAPA CANOA', 'categoria_id' => 2],
            ['nombre' => 'CALAMAR', 'categoria_id' => 2],
            ['nombre' => 'ATÚN', 'categoria_id' => 2],
            ['nombre' => 'BOLITAS DE QUESO', 'categoria_id' => 2],
            ['nombre' => 'BRACITOS', 'categoria_id' => 2],
            ['nombre' => 'PAPA EMOTICON', 'categoria_id' => 2],
            ['nombre' => 'CAMARÓN', 'categoria_id' => 2],
            ['nombre' => 'NUGGET DINO', 'categoria_id' => 2],
            ['nombre' => 'NACHO', 'categoria_id' => 2],
            ['nombre' => 'PAPAEMOTICON', 'categoria_id' => 2],
        ])->each(fn ($producto) => Producto::create($producto));
    }
}
