<?php

use App\Livewire\Capturista\Cuentas\Form;
use App\Models\GastoFijo;
use App\Models\Producto;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $user = User::factory()->create();
    actingAs($user);
});

it('renders successfully', function () {
    livewire(Form::class)
        ->assertStatus(200);
});

test('Se muestra el paso 1 para registrar precio y existencia', function () {
    livewire(Form::class)
        ->assertSet('step', 1);
});

test('Se valida el paso 1', function () {
    Producto::factory()->count(10)->create();

    livewire(Form::class)
        ->assertPropertyWired('fechaVenta')
        ->set('fechaVenta', today()->toDateString())
        ->assertPropertyWired('fechaCaptura')
        ->set('fechaCaptura', today()->toDateString())
        ->set('items.0.precio', 10)
        ->assertMethodWired('step1')
        ->call('step1')
        ->assertHasNoErrors()
        ->assertSet('step', 2);
});

test('Se guarda correctamente el registro de la cuenta', function () {
    $user = User::factory()->create();
    actingAs($user);

    Producto::factory()->create();

    livewire(Form::class)
        ->assertMethodWiredToForm('store')
        ->set('fechaVenta', today()->toDateString())
        ->set('fechaCaptura', today()->toDateString())
        ->set('items.0.precio', 10)
        ->call('step1')
        ->assertHasNoErrors()
        ->call('store')
        ->assertHasNoErrors();

    expect([
        'fecha_venta' => today()->toDateString(),
        'fecha_captura' => today()->toDateString(),
    ])->toBeInDatabase('cuentas');
    /*->and([

    ])->toBeInDatabase('items_cuenta');*/
});

test('Se muestran todos los gastos', function () {
    GastoFijo::factory()->create(['sucursal_id' => auth()->user()->sucursal_id]);

    $gastos = GastoFijo::query()->where('sucursal_id', auth()->user()->sucursal_id)->get();
    livewire(Form::class)
        ->assertSet('gastos', $gastos);
});

test('Se puede agregar un nuevo gasto', function () {
    livewire(Form::class)
        ->assertMethodWired('addGasto')
        ->call('addGasto')
        ->assertCount('gasto', 2);
});

test('Se puede retirar un gasto', function () {
    livewire(Form::class)
        ->set('gastos', [
            ['concepto' => 'algo', 'precio' => 1],
            ['concepto' => 'algo', 'precio' => 1],
        ])
        ->assertMethodWired('removeGasto')
        ->call('removeGasto', 1)
        ->assertCount('gasto', 1);
});
