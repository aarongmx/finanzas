<?php

namespace App\Livewire\Administrador\Cuentas;

use App\Models\Cuenta;
use Livewire\Component;

class Show extends Component
{
    public Cuenta $cuenta;

    public function mount(Cuenta $cuenta)
    {
        $this->cuenta = $cuenta->load([
            'itemsCuenta' => [
                'producto',
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
    }

    public function downloadReporte()
    {
        return redirect()->route('reporte.cuenta', ['cuenta' => $this->cuenta->id]);
    }

    public function render()
    {
        return view('livewire.administrador.cuentas.show');
    }
}
