<?php

namespace App\Livewire\Capturista\Cuentas;

use App\Livewire\Forms\CuentaForm;
use App\Models\Cuenta;
use App\Models\ItemCuenta;
use App\Models\Producto;
use Domain\Cuentas\Actions\ProcesarItemAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Form extends Component
{
    public CuentaForm $form;

    public $step = 1;

    public $steps = [
        1 => 'Productos',
        2 => 'Salidas',
        3 => 'Gastos',
        4 => 'Créditos',
        5 => 'Prestamos',
    ];

    public $items = [];

    public $fechaVenta;
    public $fechaCaptura;

    public function rules(): array
    {
        return [
            'fechaVenta' => ['date', 'required'],
            'fechaCaptura' => ['date', 'required'],
            'items' => ['required', 'array', 'min:1'],
        ];
    }


    public function updatedFechaVenta($value)
    {
        $this->fechaCaptura = today()->format('Y-m-d');
        $fechaVentaAnterior = Carbon::parse($value)->subDay()->toDateString();

        $this->items = Producto::query()
            ->with([
                'itemsCuenta' => fn($q) => $q->whereHas('cuenta', fn($q) => $q->where('fecha_venta', $fechaVentaAnterior))
            ])
            ->get()
            ->map(function ($producto) {
                $item = $producto?->itemsCuenta->first();

                return [
                    'producto_id' => $producto->id,
                    'producto' => $producto->nombre,
                    'precio' => round($item?->precio) ?? round(floatval($item?->precio), 2) ?? 0,
                    'cantidad_existencia' => round(floatval($item?->cantidad_sobrante), 2) ?? 0,
                    'importe_existencia' => round(floatval($item?->importe_sobrante), 2) ?? 0,
                    'cantidad_entrada' => 0,
                    'importe_entrada' => 0,
                    'cantidad_salida' => 0,
                    'importe_salida' => 0,
                    'cantidad_sobrante' => 0,
                    'importe_sobrante' => 0,
                ];
            });

    }

    public function step1()
    {
        $this->validateOnly('form.fechaVenta');
        $this->validateOnly('form.fechaCaptura');
        $this->validateOnly('items');

        $this->step = 2;
    }

    public function store()
    {
        DB::transaction(function () {
            $cuenta = Cuenta::firstOrCreate([
                'fecha_venta' => $this->fechaVenta,
                'fecha_captura' => $this->fechaCaptura,
                'sucursal_id' => auth()->user()->sucursal_id,
            ]);

            collect($this->items)->each(function ($item) use (&$cuenta) {
                $attributes = (new ProcesarItemAction())($item);
                ItemCuenta::updateOrCreate([
                    ...$attributes,
                    'cuenta_id' => $cuenta->id
                ]);
            });
        });
    }

    public function render()
    {
        return view('livewire.capturista.cuentas.form');
    }
}
