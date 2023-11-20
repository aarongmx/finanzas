<?php

Route::get('/home', \App\Livewire\Capturista\Home\Index::class)->name('home');

Route::name('cuenta.')->prefix('cuenta')->group(function () {
    Route::get('/nuevas', \App\Livewire\Capturista\Cuentas\Form::class)->name('sucursal');
});

Route::name('clientes.')->prefix('clientes')->group(function () {
    Route::get('/', \App\Livewire\Capturista\Clientes\Index::class)->name('index');
});

Route::name('salidas.')->prefix('salidas')->group(function () {
    Route::get('/', \App\Livewire\Capturista\Salidas\Index::class)->name('index');
});

Route::name('gastos.')->prefix('gastos')->group(function () {
    Route::get('/', \App\Livewire\Capturista\GastosFijos\Index::class)->name('index');
});
