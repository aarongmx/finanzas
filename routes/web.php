<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', \App\Livewire\Login::class)->name('login');

Route::post('/logout', function(Request $request){
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login');
});

Route::get('reporte/{cuenta}', function(\App\Models\Cuenta $cuenta){
    $cuenta->load([
        'itemsCuenta' => [
            'producto'
        ],
        'gastosFijos',
        'salidas' => [
            'producto',
            'sucursalDestino',
        ],
        'sucursal',
        'entradas' => [
            'producto',
            'sucursalOrigen',
        ],
    ]);
    return Pdf::loadView('pdfs.cuenta-pdf', ['cuenta' => $cuenta])->download("{$cuenta->sucursal->nombre}-{$cuenta->fecha_venta}.pdf");
})->name('reporte.cuenta');


