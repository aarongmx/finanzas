<?php

Route::name('cuenta.')->prefix('cuenta')->group(function () {
    Route::get('/nuevas', \App\Livewire\Cuentas\Sucursal\Form::class)->name('sucursal');
});
