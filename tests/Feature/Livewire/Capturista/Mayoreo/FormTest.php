<?php

use App\Livewire\Capturista\Mayoreo\Form;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Form::class)
        ->assertStatus(200);
});
