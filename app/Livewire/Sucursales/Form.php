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
        } catch (\Exception $exception) {
            logger($exception);
        }
    }

    public function render()
    {
        return view('livewire.sucursales.form');
    }
}
