<?php

namespace App\Livewire\Forms;

use App\Models\Mayoreo;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MayoreoForm extends Form
{
    #[Rule(['required'])]
    public $fechaVenta;

    #[Rule(['required'])]
    public $precio;

    #[Rule(['required'])]
    public $cantidad;

    #[Rule(['required'])]
    public $productoId;

    public function store()
    {
        Mayoreo::create([
            'fecha_venta' => $this->fechaVenta,
            'precio' => $this->precio,
            'cantidad' => $this->cantidad,
            'total' => round($this->precio, 2) * round($this->cantidad, 2),
            'producto_id' => $this->productoId,
            'sucursal_id' => auth()->user()->sucursal_id,
        ]);
    }
}
