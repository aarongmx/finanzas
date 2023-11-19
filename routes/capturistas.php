<?php

Route::get('/home', \App\Livewire\Capturista\Home\Index::class)->name('home');

Route::name('cuenta.')->prefix('cuenta')->group(function () {
    Route::get('/nuevas', \App\Livewire\Cuentas\Sucursal\Form::class)->name('sucursal');
});
