<?php

Route::get('/home', \App\Livewire\Administrador\Home\Index::class)->name('home');

Route::name('clientes.')->prefix('clientes')->group(function () {
    Route::get('/', \App\Livewire\Administrador\Clientes\Index::class)->name('index');
    Route::get('/nuevo', \App\Livewire\Administrador\Clientes\Form::class)->name('form');
});

Route::name('sucursales.')->prefix('sucursales')->group(function () {
    Route::get('/', \App\Livewire\Administrador\Sucursales\Index::class)->name('index');
});

Route::name('cuentas.')->prefix('cuentas')->group(function () {
    Route::get('/', \App\Livewire\Administrador\Cuentas\Index::class)->name('index');
    Route::get('/nueva', \App\Livewire\Administrador\Cuentas\Form::class)->name('form');

});

Route::name('productos.')->prefix('productos')->group(function () {
    Route::get('/', \App\Livewire\Administrador\Productos\Index::class)->name('index');
    Route::get('/nuevo', \App\Livewire\Administrador\Productos\Form::class)->name('form');
});

Route::name('usuarios.')->prefix('usuarios')->group(function () {
    Route::get('/', \App\Livewire\Administrador\Usuarios\Index::class)->name('index');
});
