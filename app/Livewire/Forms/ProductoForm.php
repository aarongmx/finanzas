<?php

namespace App\Livewire\Forms;

use App\Models\Producto;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ProductoForm extends Form
{
    public ?Producto $producto = null;

    #[Rule(['required'])]
    public string $nombre = '';

    #[Rule(['required'])]
    public int $categoria_id = 0;

    public function setForm(Producto $producto)
    {
        $this->producto = $producto;
        $this->nombre = $producto->nombre;
        $this->categoria_id = $producto->categoria_id;
    }

    public function store()
    {
        if (is_null($this->producto)) {
            Producto::create($this->all());
        }

        if (! is_null($this->producto)) {
            $this->producto->update([
                'nombre' => $this->nombre,
                'categoria_id' => $this->categoria_id,
            ]);
        }
    }
}
