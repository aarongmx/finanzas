<?php

namespace App\Livewire\Forms;

use App\Models\Credito;
use App\Models\Cuenta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CreditoForm extends Form
{
    #[Rule(['required'])]
    public int $clienteId;

    #[Rule(['required', 'numeric'])]
    public float $monto;

    #[Rule(['required', 'date'])]
    public $fechaCredito;

    public function store()
    {
        DB::transaction(function () {
            $fecha = Carbon::parse($this->fechaCredito);
            $fechaVencimiento = $fecha->addDays(7);

            $cuenta = Cuenta::firstOrCreate([
                'fecha_venta' => today(),
                'sucursal_id' => auth()->user()->sucursal_id
            ]);

            Credito::create([
                'cliente_id' => $this->clienteId,
                'estatus_id' => 1,
                'monto' => $this->monto,
                'saldo' => $this->monto,
                'fecha_credito' => $fecha,
                'fecha_vencimiento' => $fechaVencimiento,
                'cuenta_id' => $cuenta->id
            ]);
        });
    }
}
