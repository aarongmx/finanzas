<?php

use App\Livewire\Clientes\Index;
use App\Models\Cliente;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('Se muestr la ruta del componente correctamente', function () {
    get('/clientes')->assertSuccessful();
});

test('Se muestran los clientes', function () {
    $clientes = Cliente::factory()->count(10)->create();

    $cliente = $clientes->first();

    livewire(Index::class)
        ->assertCount('clientes', 10)
        ->assertSee($cliente->rfc)
        ->assertSee($cliente->razon_social)
        ->assertSee($cliente->sucursal->nombre);
});
