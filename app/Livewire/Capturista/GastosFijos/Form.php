<?php

namespace App\Livewire\Capturista\GastosFijos;

use App\Livewire\Forms\GastoForm;
use Livewire\Component;

class Form extends Component
{
    public GastoForm $form;

    public function store()
    {
        $this->validate();
        try {
            $this->form->store();
            $this->closeModal('gasto-modal');
            $this->notify('Gasto registrado correctamente!', 'El gasto se registro correctamente en sistema!');
            $this->dispatch('refresh');
        } catch (\Exception $exception) {
            logger($exception);
        }
    }

    public function render()
    {
        return view('livewire.capturista.gastos-fijos.form');
    }
}
