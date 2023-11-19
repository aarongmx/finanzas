<?php

Route::get('/home', \App\Livewire\Capturista\Home\Index::class)->name('home');

Route::name('cuenta.')->prefix('cuenta')->group(function () {
    Route::get('/nuevas', \App\Livewire\Capturista\Cuentas\Form::class)->name('sucursal');
});

Route::name('clientes.')->prefix('clientes')->group(function () {
    Route::get('/', \App\Livewire\Capturista\Clientes\Index::class)->name('index');
});
