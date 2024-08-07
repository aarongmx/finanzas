<?php

namespace App\Livewire\Capturista\Cuentas;

use App\Livewire\Forms\CuentaForm;
use App\Models\Cuenta;
use App\Models\Entrada;
use App\Models\GastoFijo;
use App\Models\ItemCuenta;
use App\Models\Mayoreo;
use App\Models\Producto;
use App\Models\Salida;
use Domain\Cuentas\Actions\ProcesarItemAction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Form extends Component
{
    public CuentaForm $form;

    public $step = 1;

    public $steps = [
        1 => 'Existencia',
        2 => 'Entradas',
        3 => 'Entradas recibidas',
        4 => 'Salidas',
        5 => 'Salidas a sucursal',
        6 => 'Mayoreo',
        7 => 'Sobrantes',
        8 => 'Gastos',
        9 => 'Totales',
    ];

    public $items = [];

    public $gastos = [
        ['concepto' => '', 'precio' => 0],
    ];

    public $importeExistencia = 0;

    public $fechaVenta;

    public $fechaCaptura;

    public $efectivo;

    public $aCuenta;

    public $totalEntrada = 0;

    public $sumEntradasRecibidas = 0;

    public $totalSalidas = 0;

    public $totalSobrante = 0;

    public $mayoreos = [];

    public $salidas = [];

    public $entradas = [];

    public $entradasArray = [];

    public $sumExistencia = 0;

    public $sumSobrante = 0;

    public $sumEntrada = 0;

    public $sumSalida = 0;

    public $sumGastos = 0;

    public $efectivoMarinado = 0;

    public $saldo = 0;

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
            //'entradas.*' => ['nullable', 'array'],
            'efectivo' => ['required', 'numeric'],
            'efectivoMarinado' => ['required', 'numeric'],
        ];
    }

    private function extractValues(Producto $producto)
    {
        $item = $producto->itemsCuenta->first();
        $cantidadSobrante = 0.0;
        $importeSobrante = 0.0;
        if ($producto->categoria_id === 2) {
            $cantidadSobrante = $item?->cantidad_sobrante ?? 0;
            $importeSobrante = $item?->importe_sobrante ?? 0;
        }

        return [
            'producto_id' => $producto->id,
            'producto' => $producto->nombre,
            'categoria_id' => $producto->categoria_id,
            'precio' => round($item?->precio) ?? round(floatval($item?->precio), 2) ?? 0,
            'cantidad_existencia' => round(floatval($item?->cantidad_sobrante), 2) ?? 0,
            'importe_existencia' => round(floatval($item?->importe_sobrante), 2) ?? 0,
            'cantidad_entrada' => 0,
            'importe_entrada' => 0,
            'cantidad_salida' => 0,
            'importe_salida' => 0,
            'cantidad_sobrante' => $cantidadSobrante,
            'importe_sobrante' => $importeSobrante,
        ];
    }

    public function updatedFechaVenta($value)
    {
        $this->fechaCaptura = today()->format('Y-m-d');
        $fechaVentaAnterior = Carbon::parse($value)->subDay()->toDateString();

        $this->entradas = Entrada::query()
            ->select(['id', 'producto_id', 'precio', 'sucursal_origen_id', 'cantidad'])
            ->where('fecha_entrada', $value)
            ->where('sucursal_destino_id', auth()->user()->sucursal_id)->get();
        $this->entradasArray = $this->entradas->toArray();

        $this->salidas = Salida::query()->where('fecha_salida', $value)->where('sucursal_origen_id', auth()->user()->sucursal_id)->get();

        $this->mayoreos = Mayoreo::query()->where('fecha_venta', $value)->where('sucursal_id', auth()->user()->sucursal_id)->with(['producto:id,nombre'])->get();

        $this->items = Producto::query()
            ->with([
                'itemsCuenta' => fn ($q) => $q->whereHas('cuenta', fn ($q) => $q->where('sucursal_id', auth()->user()->sucursal_id)->where('fecha_venta', $fechaVentaAnterior)),
            ])
            ->orderBy('nombre')
            ->get()
            ->map(fn ($p) => $this->extractValues($p));

        $this->importeExistencia = $this->items->sum('importe_existencia');
        $this->totalSalidas = $this->salidas->sum('total') + $this->mayoreos->sum('total');
        $this->sumSalida = $this->totalSalidas ?? 0;
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
        $this->step = 4;
    }

    public function step4()
    {
        $this->validateOnly('items.*.cantidad_salida');
        $this->step = 5;
    }

    public function step5()
    {
        $this->step = 6;
    }

    public function step6()
    {
        $this->step = 7;
    }

    public function step7()
    {
        $this->step = 8;
    }

    public function step8()
    {
        $this->step = 9;
    }

    public function back($step)
    {
        $this->step = $step;
    }

    public function store()
    {
        try {
            DB::transaction(function () {
                $montoTotal = $this->efectivo + $this->efectivoMarinado;

                $cuenta = Cuenta::query()->updateOrCreate([
                    'fecha_venta' => $this->fechaVenta,
                    'sucursal_id' => auth()->user()->sucursal_id,
                ], [
                    'fecha_captura' => $this->fechaCaptura,
                    'efectivo_marinado' => $this->efectivoMarinado,
                    'efectivo_pollo' => $this->efectivo,
                    'efectivo_total' => $montoTotal,
                    'saldo' => 0,
                ]);
                ray($this->items);
                collect($this->items)->each(function ($item) use (&$cuenta) {
                    $attributes = (new ProcesarItemAction)($item);
                    ItemCuenta::query()->updateOrCreate([
                        ...$attributes,
                        'cuenta_id' => $cuenta->id,
                    ]);
                });

                collect($this->entradasArray)->each(function ($e) {
                    Entrada::updateOrCreate([
                        'id' => $e['id'],
                    ], [
                        'precio' => $e['precio'],
                    ]);
                });

                collect($this->gastos)->each(function ($gasto) use (&$cuenta) {
                    if (! empty($gasto['precio']) && ! empty($gasto['concepto'])) {
                        GastoFijo::updateOrCreate([
                            'concepto' => $gasto['concepto'],
                            'sucursal_id' => auth()->user()->sucursal_id,
                            'cuenta_id' => $cuenta->id,
                        ], [
                            'precio' => $gasto['precio'],
                        ]);
                    }
                });
            });

            $this->notify('Cuenta registrada correctamente!', 'Se registro correctamente la cuenta!');
        } catch (\Exception $exception) {
            logger($exception);
        }
    }

    public function addGasto()
    {
        $this->gastos[] = [
            'concepto' => '',
            'precio' => 0,
        ];
    }

    public function removeGasto($index)
    {
        unset($this->gastos[$index]);
    }

    public function render()
    {
        return view('livewire.capturista.cuentas.form');
    }
}
