<?php

namespace App\Livewire\Clientes;

use App\Models\Cliente;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    #[Computed]
    public function clientes()
    {
        return Cliente::query()->get();
    }

    public function render()
    {
        return view('livewire.clientes.index');
    }
}
