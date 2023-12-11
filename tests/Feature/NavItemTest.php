<?php

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

uses(InteractsWithViews::class);


test('test', function () {
    $this->blade('<x-nav-item path="capturista.entrada.index">Hola</x-nav-item>')
        ->assertSee('nav-item')
        ->assertSee('/capturista/clientes')
        ->assertSee('Hola');
});
