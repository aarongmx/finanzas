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


    public function store()
    {
        DB::transaction(function () {
            $cuenta = Cuenta::firstOrCreate([
                'sucursal_id' => auth()->user()->sucursal_id,
                'fecha_venta' => today()->toDate()
            ]);

            $salida = Salida::updateOrCreate([
                'precio' => $this->precio,
                'cantidad' => $this->cantidad,
                'producto_id' => $this->productoId,
                'total' => round($this->cantidad * $this->precio, 2),
                'sucursal_destino_id' => $this->sucursalDestinoId,
                'cuenta_id' => $cuenta->id
            ]);

            Entrada::create([
                'sucursal_id' => $this->sucursalDestinoId,
                'sucursal_envio_id' => auth()->user()->sucursal_id,
                'precio_envio' => $this->precio,
                'cantidad' => $this->cantidad,
                'precio' => 0,
                'salida_id' => $salida->id,
                'producto_id' => $this->productoId,
                'fecha' => today()->toDateString()
            ]);
        });
    }
}
