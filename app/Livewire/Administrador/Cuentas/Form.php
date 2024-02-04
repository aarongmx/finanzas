<?php

namespace App\Livewire\Administrador\Cuentas;

use App\Livewire\Forms\CuentaForm;
use App\Models\Categoria;
use App\Models\ItemCuenta;
use App\Models\Producto;
use App\Models\Sucursal;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Form extends Component
{
    #public CuentaForm $form;

    public $items = [];

    public $categoriaSeleccionada;

    #[Computed]
    public function categorias()
    {
        return Categoria::query()->get();
    }

    #[Computed]
    public function sucursales()
    {
        return Sucursal::query()->select(['id', 'nombre'])->get();
    }

    public function mount()
    {
        $this->items = Producto::query()
            ->with([
                'itemsCuenta' => fn($q) => $q->whereHas('cuenta', fn($q) => $q->where('fecha_venta', today()->subDay()))->limit(1)
            ])
            ->get()
            ->map(function ($producto) {
                $item = $producto?->itemsCuenta?->first();
                return [
                    'producto_name' => $producto->nombre,
                    'producto_id' => $producto->id,
                    'precio' => $item->precio ?? 0,
                    'importe_existencia' => $item->importe_existencia ?? 0,
                    'cantidad_existencia' => $item->cantidad_existencia ?? 0,
                    'cantidad_sobrante' => $producto->categoria_id === 2 ? ($item?->cantidad_sobrante) ?? 0 : 0,
                    'importe_sobrante' => $producto->categoria_id === 2 ? ($item?->importe_sobrante) ?? 0 : 0,
                    'categoria_id' => $producto->categoria_id,
                ];
            })->toArray();
    }

    public function render()
    {
        return view('livewire.administrador.cuentas.form');
    }
}
