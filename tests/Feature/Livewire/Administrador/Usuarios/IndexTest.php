<?php

use App\Livewire\Administrador\Usuarios\Index;
use function Pest\Livewire\livewire;

it('renders successfully', function () {
    livewire(Index::class)
        ->assertStatus(200);
});

