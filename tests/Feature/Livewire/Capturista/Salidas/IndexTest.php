<?php

use App\Livewire\Capturista\Salidas\Index;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Index::class)
        ->assertStatus(200);
});
