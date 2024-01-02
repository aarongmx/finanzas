<?php

use App\Livewire\Administrador\Cuentas\Show;
use App\Models\Cuenta;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

beforeEach(function(){
    $this->cuenta = Cuenta::factory()->create();
});

it('renders successfully', function () {
    livewire(Show::class)
        ->assertStatus(200);
});

test('Se muestra el componente en la ruta correcta', function () {
    get("/administracion/cuentas/{$this->cuenta->id}")->assertSuccessful();
});
