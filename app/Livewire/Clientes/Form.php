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
        $this->form->store();
    }

    public function render()
    {
        return view('livewire.clientes.form');
    }
}
