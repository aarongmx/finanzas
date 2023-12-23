<?php

namespace App\Livewire\Capturista\Cuentas;

use App\Livewire\Forms\CuentaForm;
use App\Models\Cuenta;
use App\Models\Entrada;
use App\Models\GastoFijo;
use App\Models\ItemCuenta;
use App\Models\Producto;
use Domain\Cuentas\Actions\ProcesarItemAction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Form extends Component
{
    public CuentaForm $form;

    public $step = 1;

    public $steps = [
        1 => 'Existencia',
        2 => 'Entardas',
        3 => 'Salidas',
        4 => 'Sobrantes',
        5 => 'Gastos',
        6 => 'Totales',
    ];

    public $items = [];

    public $gasto = [
        ['concepto' => '', 'precio' => 0]
    ];

    public $cantidadExistencia = 0;
    public $importeExistencia = 0;

    public $fechaVenta;
    public $fechaCaptura;

    public $efectivo;
    public $aCuenta;

    public function rules(): array
    {
        return [
            'fechaVenta' => ['date', 'required'],
            'fechaCaptura' => ['date', 'required'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.precio' => ['required', 'numeric'],
            'items.*.cantidad_entrada' => ['required', 'numeric'],
            'items.*.cantidad_salida' => ['required', 'numeric'],
            'items.*.cantidad_sobrante' => ['required', 'numeric'],
            'efectivo' => ['required', 'numeric'],
            'aCuenta' => ['required', 'numeric'],
        ];
    }

    public function mount()
    {
        $this->items = Producto::query()
            ->with([
                'itemsCuenta' => fn($q) => $q->whereHas('cuenta', fn($q) => $q->where('fecha_venta', today()->subDay()))
            ])
            ->get()
            ->map(fn($p) => $this->extractValues($p));
    }

    private function extractValues(Producto $producto)
    {
        $item = $producto->itemsCuenta->first();

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
            ->map(fn($p) => $this->extractValues($p));

        $this->cantidadExistencia = $this->items->sum('cantidad_existencia');
        $this->importeExistencia = $this->items->sum('importe_existencia');
    }

    public function step1()
    {
        $this->validateOnly('fechaVenta');
        $this->validateOnly('fechaCaptura');
        $this->validateOnly('items.*.precio');

        $this->step = 2;
    }

    public function step2()
    {
        $this->validateOnly('items.*.cantidad_entrada');
        $this->step = 3;
    }

    public function step3()
    {
        $this->validateOnly('items.*.cantidad_salida');
        $this->step = 4;
    }

    public function step4()
    {
        $this->step = 5;
    }

    public function step5()
    {
        $this->step = 6;
    }

    public function back($step)
    {
        $this->step = $step;
    }

    public function store()
    {
        try {
            DB::transaction(function () {
                $cuenta = Cuenta::query()->firstOrCreate([
                    'fecha_venta' => $this->fechaVenta,
                    'fecha_captura' => $this->fechaCaptura,
                    'sucursal_id' => auth()->user()->sucursal_id,
                    'efectivo' => $this->efectivo,
                    'a_cuenta' => $this->aCuenta,
                ]);

                collect($this->items)->each(function ($item) use (&$cuenta) {
                    $attributes = (new ProcesarItemAction())($item);
                    ItemCuenta::query()->updateOrCreate([
                        ...$attributes,
                        'cuenta_id' => $cuenta->id
                    ]);
                });

                collect($this->gasto)->each(function ($gasto) use (&$cuenta) {
                    ray($cuenta);
                    if (!empty($gasto['precio']) && !empty($gasto['concepto'])) {
                        GastoFijo::create([
                            'concepto' => $gasto['concepto'],
                            'precio' => $gasto['precio'],
                            'sucursal_id' => auth()->user()->sucursal_id,
                            'cuenta_id' => $cuenta->id,
                        ]);
                    }
                });
            });

            $this->notify('Cuenta registrada correctamente!', 'Se registro correctamente la cuenta!');
        } catch (\Exception $exception) {
            logger($exception);
        }
    }

    #[Computed]
    public function gastos()
    {
        return GastoFijo::query()
            ->where('sucursal_id', auth()->user()->sucursal_id)
            ->get();
    }

    public function addGasto()
    {
        $this->gasto[] = [
            'concepto' => '',
            'precio' => 0
        ];
    }

    public function removeGasto($index)
    {
        unset($this->gasto[$index]);
    }

    public function arrastrarDatosMarinados()
    {

    }

    public function render()
    {
        return view('livewire.capturista.cuentas.form');
    }
}
