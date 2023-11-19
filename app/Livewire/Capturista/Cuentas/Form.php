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
        $cuenta = Cuenta::query()->with([
            'itemsCuenta' => [
                'producto:id,nombre,categoria_id' => [
                    'categoria:id,nombre'
                ],
            ],
        ])
            ->when($value, fn($q) => $q->where('fecha_venta', Carbon::parse($value)->subDay()))
            ->first();
        $this->items = $cuenta?->itemsCuenta?->map(fn($item) => [
            'producto' => $item->producto->nombre,
            'precio' => round(floatval($item->precio), 2),
            'cantidad_existencia' => round(floatval($item->cantidad_existencia), 2),
            'importe_existencia' => round(floatval($item->importe_existencia), 2),
            'cantidad_entrada' => 0,
            'importe_entrada' => 0,
            'cantidad_salida' => 0,
            'importe_salida' => 0,
            'cantidad_sobrante' => 0,
            'importe_sobrante' => 0,
        ])->toArray() ?? [];
    }


    public function render()
    {
        return view('livewire.capturista.cuentas.form');
    }
}
