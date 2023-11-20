<?php

namespace App\Livewire\Forms;

use App\Models\GastoFijo;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GastoForm extends Form
{
    #[Rule(['required'])]
    public float $precio;

    #[Rule(['required'])]
    public string $concepto;

    public function store()
    {
        GastoFijo::create([
            'precio' => $this->precio,
            'concepto' => $this->concepto,
            'sucursal_id' => auth()->user()->sucursal_id,
        ]);
    }
}
