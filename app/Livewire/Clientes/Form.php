<?php

namespace App\Livewire\Clientes;

use App\Livewire\Forms\ClienteForm;
use Livewire\Component;

class Form extends Component
{
    public ClienteForm $form;

    public function save()
    {
        $this->validate();
        try {
            $this->form->store();
            $this->dispatch('refresh')->to(Index::class);
            $this->closeModal('exampleModal');
            $this->notify('Cliente guardaro!', 'El cliente se registro correctamente!');
        } catch (\Exception $exception) {
            logger($exception);
            $this->notify('Hubo un error al intentar crear el cliente!', 'Intente crear el cliente en otro momento', 'error');
        }
    }

    public function render()
    {
        return view('livewire.clientes.form');
    }
}
