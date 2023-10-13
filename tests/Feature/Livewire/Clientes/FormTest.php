<?php

use App\Livewire\Clientes\Form;
use App\Models\Sucursal;
use function Pest\Livewire\livewire;

beforeEach(function (){
    Sucursal::factory()->create();
});

test('Se puede registrar un cliente', function () {
    livewire(Form::class)
        ->assertMethodWiredToForm('save')
        ->assertPropertyWired('form.rfc')
        ->set('form.rfc', 'GOMA971007BD8')
        ->set('form.razonSocial', 'Aaron Gómez')
        ->set('form.codigoPostal', '09660')
        ->call('save')
        ->assertHasNoErrors();

    expect([
        'rfc' => 'GOMA971007BD8',
        'razon_social' => 'Aaron Gómez'
    ])->toBeInDatabase('clientes');
});
