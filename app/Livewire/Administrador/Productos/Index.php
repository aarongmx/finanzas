<?php

namespace App\Livewire\Administrador\Productos;

use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    #[On('refresh')]
    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.administrador.productos.index');
    }
}
