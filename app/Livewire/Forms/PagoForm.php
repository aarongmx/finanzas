<?php

namespace App\Livewire\Forms;

use App\Enums\EstatusPago;
use App\Models\Credito;
use App\Models\Pago;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Form;

class PagoForm extends Form
{
    public ?Credito $credito;

    #[Rule(['required'])]
    public float $monto;

    #[Rule(['required'])]
    public $fecha;

    public function store(): void
    {
        throw_if($this->monto > $this->credito->saldo, new \Exception('El monto pagado excede el saldo del crédito!'));

        DB::transaction(function () {
            Pago::create([
                'monto' => $this->monto,
                'fecha_pago' => Carbon::parse($this->fecha),
                'pagable_type' => $this->credito::class,
                'pagable_id' => $this->credito->id,
            ]);

            $saldo = round($this->credito->saldo, 2) - round($this->monto, 2);

            if ($saldo > 0 || $saldo > 0.0) {
                $this->credito->update(['saldo' => $saldo, 'estatus_id' => EstatusPago::PAGO_PARCIAL]);
            }

            if ($saldo == 0) {
                $this->credito->update(['saldo' => $saldo, 'estatus_id' => EstatusPago::PAGADO]);
            }
        });
    }
}
