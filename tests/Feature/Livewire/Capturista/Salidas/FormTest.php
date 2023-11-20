<?php

use App\Livewire\Capturista\Salidas\Form;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('renders successfully', function () {
    livewire(Form::class)
        ->assertStatus(200);
});

test('Se muestran los productos', function () {
    Producto::factory()->count(10)->create();
    $productos = Producto::query()->get();

    livewire(Form::class)->assertSet('productos', $productos);
});

test('Se muestran las sucursales de destino', function () {
    Sucursal::factory()->count(10)->create();
    $sucursal = Sucursal::query()->get();

    livewire(Form::class)->assertSet('sucursales', $sucursal);
});

test('se muestran los campos para el formulario', function () {
    livewire(Form::class)
        ->assertMethodWiredToForm('store')
        ->assertPropertyWired('form.precio')
        ->assertPropertyWired('form.cantidad')
        ->assertPropertyWired('form.productoId')
        ->assertPropertyWired('form.sucursalDestinoId');
});

test('Se guarda correctamente la información', function () {
    Producto::factory()->create();
    Sucursal::factory()->create();
    $user = User::factory()->create();

    actingAs($user);

    $producto = Producto::first();
    $sucursal = Sucursal::first();

    livewire(Form::class)
        ->set('form.precio', 100.45)
        ->set('form.cantidad', 10)
        ->set('form.productoId', $producto->id)
        ->set('form.sucursalDestinoId', $sucursal->id)
        ->call('store')
        ->assertHasNoErrors()
        ->dispatch('closeModal');

    expect([
        'precio' => 100.45,
        'cantidad' => 10,
        'producto_id' => $producto->id,
        'sucursal_destino_id' => $sucursal->id,
    ])->toBeInDatabase('salidas');
});
