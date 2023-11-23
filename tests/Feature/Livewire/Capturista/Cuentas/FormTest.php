<?php

use App\Livewire\Capturista\Cuentas\Form;
use App\Models\ItemCuenta;
use App\Models\Producto;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

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
        ->set('fechaVenta', today())
        ->assertPropertyWired('fechaCaptura')
        ->set('fechaCaptura', today())
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
        ->set('fechaVenta', today())
        ->set('fechaCaptura', today())
        ->set('items.0.precio', 10)
        ->call('step1')
        ->assertHasNoErrors()
        ->call('store')
        ->assertHasNoErrors();

    expect([
        'fecha_venta' => today(),
        'fecha_captura' => today(),
    ])->toBeInDatabase('cuentas');
    /*->and([

    ])->toBeInDatabase('items_cuenta');*/
});
