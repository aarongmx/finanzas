<?php

namespace App\Livewire\Forms;

use App\Models\Producto;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ProductoForm extends Form
{
    #[Rule(['required'])]
    public string $nombre;

    #[Rule(['required'])]
    public int $categoria_id;

    public function store()
    {
        Producto::create($this->all());
    }
}
