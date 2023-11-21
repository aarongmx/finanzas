<?php

use App\Livewire\Capturista\Pagos\Form;
use App\Models\Credito;
use function Pest\Livewire\livewire;

it('renders successfully', function () {
    livewire(Form::class)
        ->assertStatus(200);
});

test('Se muestran los campos para crear el abono', function () {
    livewire(Form::class)
        ->assertMethodWiredToForm('store')
        ->assertPropertyWired('form.monto')
        ->assertPropertyWired('form.fecha');
});

test('Se registra pago correctamente', function () {
    $credito = Credito::factory()->create();

    livewire(Form::class, ['credito' => $credito])
        ->set('form.monto', $credito->monto)
        ->set('form.fecha', today())
        ->call('store')
        ->assertHasNoErrors()
        ->assertDispatched('closeModal')
        ->assertDispatched('notify')
        ->assertDispatched('refresh');

    expect([
        'id' => $credito->id,
        'saldo' => 0
    ])->toBeInDatabase('creditos')
        ->and([
            'pagable_id' => $credito->id,
            'pagable_type' => $credito::class,
            'monto' => $credito->monto,
        ])->toBeInDatabase('pagos');
});
