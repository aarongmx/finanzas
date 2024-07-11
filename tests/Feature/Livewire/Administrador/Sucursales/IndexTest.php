<?php

use App\Livewire\Sucursales\Index;

use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('Se muestra la url de sucursales', function () {
    get('/sucursales')->assertSuccessful();
});

test('Se renderiza correctamente el componente', function () {
    livewire(Index::class)->assertSuccessful();
});
