<?php

namespace App\Livewire\Forms;

use App\Models\Cuenta;
use App\Models\Entrada;
use App\Models\ItemCuenta;
use App\Models\Salida;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Illuminate\Support\Facades\DB;

class SalidaForm extends Form
{
    #[Rule(['required'])]
    public float $precio = 0.0;

    #[Rule(['required'])]
    public float $cantidad = 0.0;

    #[Rule(['required'])]
    public int $productoId;

    #[Rule(['required'])]
    public int $sucursalDestinoId;

    #[Rule('required')]
    public $fechaVenta;

    public function store()
    {
        DB::transaction(function () {
            $cuenta = Cuenta::firstOrCreate([
                'sucursal_id' => auth()->user()->sucursal_id,
                'fecha_venta' => $this->fechaVenta,
            ], [
                'efectivo_pollo' => 0,
                'efectivo_marinado' => 0,
                'efectivo_total' => 0,
                'saldo' => 0
            ]);

            $salida = Salida::create([
                'producto_id' => $this->productoId,
                'fecha_salida' => $this->fechaVenta,
                'sucursal_origen_id' => auth()->user()->sucursal_id,
                'sucursal_destino_id' => $this->sucursalDestinoId,
                'cuenta_id' => $cuenta->id,
                'precio' => $this->precio,
                'cantidad' => $this->cantidad,
                'total' => round($this->cantidad * $this->precio, 2),
            ]);

            $cuentaDestino = Cuenta::firstOrCreate([
                'sucursal_id' => $this->sucursalDestinoId,
                'fecha_venta' => $this->fechaVenta,
            ], [
                'efectivo_pollo' => 0,
                'efectivo_marinado' => 0,
                'efectivo_total' => 0,
                'saldo' => 0
            ]);

            Entrada::create([
                'sucursal_destino_id' => $this->sucursalDestinoId,
                'sucursal_origen_id' => auth()->user()->sucursal_id,
                'precio_envio' => $this->precio,
                'cantidad' => $this->cantidad,
                'precio' => 0,
                'salida_id' => $salida->id,
                'producto_id' => $this->productoId,
                'fecha_entrada' => $this->fechaVenta,
                'cuenta_id' => $cuentaDestino->id,
                'total' => 0,
            ]);
        });
    }
}
