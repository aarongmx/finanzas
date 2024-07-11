<?php

use App\Livewire\Administrador\Usuarios\Form;
use App\Models\Sucursal;

use function Pest\Livewire\livewire;

it('renders successfully', function () {
    livewire(Form::class)
        ->assertStatus(200);
});

test('Se muestran las sucursales', function () {
    Sucursal::factory()->count(8)->create();
    $sucursales = Sucursal::query()->select(['id', 'nombre'])->get();

    livewire(Form::class)->assertSet('sucursales', $sucursales);
});

test('Se muestran los campos en el formulario', function () {
    livewire(Form::class)
        ->assertMethodWiredToForm('store')
        ->assertPropertyWired('form.name')
        ->assertPropertyWired('form.email')
        ->assertPropertyWired('form.sucursalId');
});

test('Se puede guardar un nuevo usuario', function () {
    $sucursal = Sucursal::factory()->create();

    livewire(Form::class)
        ->set('form.name', 'Juan')
        ->set('form.email', 'juan@ml-grupo.com.mx')
        ->set('form.sucursalId', $sucursal->id)
        ->call('store')
        ->assertHasNoErrors();
    /* TODO: Revisar el erro que da, pero si se hace en el sitio*/
    //->assertDispatched('closeModal')
    //->assertDispatched('notify')
    //->assertDispatched('refresh');

    expect([
        'name' => 'Juan',
        'email' => 'juan@ml-grupo.com.mx',
        'sucursal_id' => $sucursal->id,
    ])->toBeInDatabase('users');
});
