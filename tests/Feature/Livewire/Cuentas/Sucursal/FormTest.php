<?php

use App\Livewire\Cuentas\Sucursal\Form;
use function Pest\Livewire\livewire;

it('renders successfully', function () {
    livewire(Form::class)
        ->assertStatus(200);
});

test('Se muestra el paso 1 para registrar precio y existencia', function () {
    livewire(Form::class)
        ->assertSet('step', 1);
});
