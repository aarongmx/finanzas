<?php

use App\Enums\Role;
use App\Livewire\Administrador\Clientes\Form;
use App\Models\Sucursal;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

beforeEach(function () {
    seed(PermissionsSeeder::class);

    $user = User::factory()->create();
    $user->assignRole(Role::ADMINISTRACION);

    actingAs($user);
});

test('Se muestran las sucursales disponibles', function () {
    Sucursal::factory()->count(4)->create();
    $sucursales = Sucursal::query()->select(['id', 'nombre'])->get();

    livewire(Form::class)->assertSet('sucursales', $sucursales);
});

test('Se muestra select de sucursales si el usuario es administrador', function () {
    livewire(Form::class)->assertPropertyWired('form.sucursalId');
});

test('Se puede registrar un cliente', function () {
    livewire(Form::class)
        ->assertMethodWiredToForm('save')
        ->assertPropertyWired('form.rfc')
        ->set('form.rfc', 'GOMA971007BD8')
        ->set('form.razonSocial', 'Aaron Gómez')
        ->set('form.codigoPostal', '09660')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('closeModal', modal: 'nuevo-cliente-modal')
        ->assertDispatched('notify');

    expect([
        'rfc' => 'GOMA971007BD8',
        'razon_social' => 'Aaron Gómez',
    ])->toBeInDatabase('clientes');
});
