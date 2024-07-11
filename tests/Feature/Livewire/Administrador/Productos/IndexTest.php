<?php

use App\Livewire\Productos\Index;

use function Pest\Livewire\livewire;

it('renders successfully', function () {
    livewire(Index::class)
        ->assertStatus(200);
});
