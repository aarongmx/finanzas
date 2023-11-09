<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', \App\Livewire\Login::class);

Route::name('clientes.')->prefix('clientes')->group(function () {
    Route::get('/', \App\Livewire\Clientes\Index::class)->name('index');
    Route::get('/nuevo', \App\Livewire\Clientes\Form::class)->name('form');
});

Route::name('sucursales.')->prefix('sucursales')->group(function () {
    Route::get('/', \App\Livewire\Sucursales\Index::class)->name('index');
});

Route::name('cuentas.')->prefix('cuentas')->group(function () {
    Route::get('/', \App\Livewire\Cuentas\Index::class)->name('index');
});


