<?php

use App\Enums\Role;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        PermissionsSeeder::class,
    ]);
});

test('El nav se muestra correctamente para los capturistas', function () {
    $user = User::factory()->create();
    $user->role(Role::CAPTURISTA);
    actingAs($user);

    $component = $this->blade('<x-nav/>');
    ray($component);
    $component->assertSee(auth()->user()->name)->assertSee(auth()->user()->sucursal->nombre);
});

test('El nav se muestre correctamente para los administradores', function () {
    $user = User::factory()->sinSucursal()->create();
    $user->role(Role::ADMINISTRACION);
    actingAs($user);

    $component = $this->blade('<x-nav/>');
    ray($component);
    $component->assertSee(auth()->user()->name);
});
