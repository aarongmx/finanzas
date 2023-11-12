<?php

namespace App\Livewire\Sucursales;

use App\Livewire\Forms\SucursalForm;
use Livewire\Component;

class Form extends Component
{
    public SucursalForm $form;

    public function store()
    {
        $this->validate();
        try {
            $this->form->store();
            $this->dispatch('refresh')->to(Index::class);
            $this->closeModal('exampleModal');
            $this->notify('Sucursal guardada!', 'La sucursal se agrego correctamente!');
        } catch (\Exception $exception) {
            logger($exception);
            $this->notify('Hubo un error al intentar crear la sucursal!', 'Intente crear la sucursal en otro momento', 'error')
        }
    }

    public function render()
    {
        return view('livewire.sucursales.form');
    }
}
