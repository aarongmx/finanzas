<?php

use App\Livewire\Capturista\Creditos\Form;
use App\Models\Cliente;
use App\Models\User;
use Database\Seeders\EstatusSeeder;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $user = User::factory()->create();
    actingAs($user);
});

it('renders successfully', function () {
    livewire(Form::class)
        ->assertStatus(200);
});

test('Se muestran los clientes', function () {
    Cliente::factory()->count(5)->create(['sucursal_id' => auth()->user()->sucursal_id]);
    $clientes = Cliente::query()->select(['id', 'nombre_comercial'])->where('sucursal_id', auth()->user()->sucursal_id)->get();

    livewire(Form::class)->assertSet('clientes', $clientes);
});

test('Se captura correctamente un crédito', function () {
    livewire(Form::class)
        ->assertMethodWiredToForm('store')
        ->assertPropertyWired('form.clienteId')
        ->assertPropertyWired('form.monto')
        ->assertPropertyWired('form.fechaCredito');
});

test('Se registra correctamente un crédito', function () {
    seed(EstatusSeeder::class);

    $cliente = Cliente::factory()->create();
    $fecha = today();

    livewire(Form::class)
        ->set('form.clienteId', $cliente->id)
        ->set('form.fechaCredito', $fecha)
        ->set('form.monto', 11600)
        ->call('store')
        ->assertHasNoErrors()
        ->assertDispatched('closeModal')
        ->assertDispatched('notify')
        ->assertDispatched('refresh');

    expect([
        'cliente_id' => $cliente->id,
        'fecha_credito' => $fecha,
        'fecha_vencimiento' => $fecha->addDays(7),
        'monto' => 11600,
        'saldo' => 11600,
        'estatus_id' => 1,
    ])->toBeInDatabase('creditos');
});
