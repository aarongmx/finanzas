<?php

namespace App\Livewire\Capturista\Salidas;

use App\Livewire\Forms\SalidaForm;
use App\Models\Producto;
use App\Models\Sucursal;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Form extends Component
{
    public SalidaForm $form;

    #[Computed]
    public function productos()
    {
        return Producto::query()->get();
    }

    #[Computed]
    public function sucursales()
    {
        return Sucursal::query()->get();
    }

    public function store()
    {
        $this->validate();

        try {
            $this->form->store();
            $this->closeModal('salida-modal');
            $this->dispatch('refresh');
        } catch (\Exception $e) {
            logger($e);
        }
    }

    public function render()
    {
        return view('livewire.capturista.salidas.form');
    }
}
