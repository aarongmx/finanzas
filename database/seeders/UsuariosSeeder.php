<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ethan',
            'email' => 'ethan@mlgrupo.com.mx',
            'password' => 'password'
        ])->assignRole(Role::ADMINISTRACION);

        User::create([
            'name' => 'Axel',
            'email' => 'axel@mlgrupo.com.mx',
            'password' => 'password',
            'sucursal_id' => Sucursal::first()->id,
        ])->assignRole(Role::CAPTURISTA);

        User::create([
            'name' => 'Aarón',
            'email' => 'aaron@mlgrupo.com.mx',
            'password' => 'password',
            'sucursal_id' => Sucursal::first()->id,
        ])->assignRole(Role::CAPTURISTA);
    }
}
