<?php

use App\Livewire\Sucursales\Form;

use function Pest\Livewire\livewire;

it('renders successfully', function () {
    livewire(Form::class)
        ->assertStatus(200);
});

test('Se muestran los campos para sucursal', function () {
    livewire(Form::class)
        ->assertMethodWiredToForm('store')
        ->assertPropertyWired('form.nombre')
        ->assertPropertyWired('form.codigo_postal')
        ->assertPropertyWired('form.colonia')
        ->assertPropertyWired('form.estado')
        ->assertPropertyWired('form.numero_interior')
        ->assertPropertyWired('form.numero_exterior')
        ->assertPropertyWired('form.calle');
});

test('Se puede registrar una sucursal correctamente', function () {
    livewire(Form::class)
        ->set('form.nombre', 'AZTECAS')
        ->set('form.codigo_postal', '09550')
        ->call('store')
        ->assertHasNoErrors()
        ->assertDispatched('closeModal')
        ->assertDispatched('notify');

    expect([
        'nombre' => 'AZTECAS',
    ])->toBeInDatabase('sucursales')
        ->and([
            'codigo_postal' => '09550',
        ])->toBeInDatabase('direcciones');
});

test('Se puede capturar una nueva sucursal', function () {
    livewire(Form::class)
        ->set('form.nombre', 'Aztecas')
        ->set('form.codigo_postal', '09660')
        ->set('form.colonia', 'colonia')
        ->set('form.estado', 'estado')
        ->set('form.numero_interior', '12-A')
        ->set('form.numero_exterior', '12')
        ->set('form.calle', 'Av. de las torres')
        ->call('store')
        ->assertHasNoErrors()
        ->assertDispatched('closeModal')
        ->assertDispatched('notify');

    expect([
        'nombre' => 'Aztecas',
    ])->toBeInDatabase('sucursales')
        ->and([
            'codigo_postal' => '09660',
            'colonia' => 'colonia',
            'estado' => 'estado',
            'numero_interior' => '12-A',
            'numero_exterior' => '12',
            'calle' => 'Av. de las torres',
        ])->toBeInDatabase('direcciones');
});
