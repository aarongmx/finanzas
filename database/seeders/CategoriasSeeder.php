<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['nombre' => 'POLLO'],
            ['nombre' => 'MARINADO'],
        ])->each(fn ($categoria) => Categoria::create($categoria));
    }
}
