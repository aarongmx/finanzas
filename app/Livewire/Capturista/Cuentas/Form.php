<?php

namespace App\Livewire\Capturista\Cuentas;

use App\Models\Cuenta;
use App\Models\Producto;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Form extends Component
{
    public $step = 1;

    public $items = [];

    public $fecha;
    public $fechaRegistro;

    public function mount()
    {

    }

    public function updatedFecha($value)
    {
        $this->fechaRegistro = today()->format('Y-m-d');

        $this->items = Producto::query()
            ->with([
                'itemCuenta' => fn($q) => $q->whereHas('cuenta', fn($q) => $q->where('fecha_venta', Carbon::parse($value)->subDay()))
            ])
            ->get()
            ->map(function ($producto) {
                $item = $producto?->itemCuenta;
                return [
                    'producto' => $producto->nombre,
                    'precio' => round(floatval($item?->precio), 2) ?? 0,
                    'cantidad_existencia' => round(floatval($item?->cantidad_existencia), 2) ?? 0,
                    'importe_existencia' => round(floatval($item?->importe_existencia), 2) ?? 0,
                    'cantidad_entrada' => 0,
                    'importe_entrada' => 0,
                    'cantidad_salida' => 0,
                    'importe_salida' => 0,
                    'cantidad_sobrante' => 0,
                    'importe_sobrante' => 0,
                ];
            });

    }


    public function render()
    {
        return view('livewire.capturista.cuentas.form');
    }
}
