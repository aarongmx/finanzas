<?php

use App\Livewire\Capturista\GastosFijos\Form;
use App\Models\Sucursal;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('renders successfully', function () {
    livewire(Form::class)
        ->assertStatus(200);
});

test('Se muestran los campos para registrar el gasto', function () {
    livewire(Form::class)
        ->assertMethodWiredToForm('store')
        ->assertPropertyWired('form.precio')
        ->assertPropertyWired('form.concepto');
});


test('Se puede registrar un nuevo gasto para la sucursal', function () {
    $user = User::factory()->create();
    actingAs($user);

    livewire(Form::class)
        ->set('form.precio', 100.5)
        ->set('form.concepto', 'renta')
        ->call('store')
        ->assertHasNoErrors()
        ->assertDispatched('closeModal')
        ->assertDispatched('notify')
        ->assertDispatched('refresh');

    expect([
        'precio' => 100.5,
        'concepto' => 'RENTA',
        'sucursal_id' => $user->sucursal_id,
    ])->toBeInDatabase('gasto_fijos');
});
